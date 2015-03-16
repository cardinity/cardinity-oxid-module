<?php

require_once __DIR__ . '/../vendor/autoload.php';

class CardinityPaymentGateway extends CardinityPaymentGateway_parent
{
    
    const STATUS_APPROVED = 'approved';

    /**
     * Executes Cardinity payment after order confirmation
     *
     * @param float $dAmount
     * @param oxOrder $oOrder
     * @return boolean
     */
    public function executePayment($dAmount, &$oOrder)
    {
        if ($this->_oPaymentInfo->oxuserpayments__oxpaymentsid->value != 'cardinity-oxid-module') {
            return parent::executePayment($dAmount, $oOrder);
        }

        $this->_iLastErrorNo = null;
        $this->_sLastError = null;

        try {
            $aPaymentInfoArr = $this->_getPaymentInfo();
            $this->_clearSensitiveData();

            $viewConfig = oxRegistry::getConfig()->getTopActiveView()->getViewConfig();

            $cardinity = \Cardinity\Client::create([
                'consumerKey' => $viewConfig->getCardinityConfigParam('consumerKey'),
                'consumerSecret' => $viewConfig->getCardinityConfigParam('consumerSecret'),
            ]);

            $payment = new \Cardinity\Method\Payment\Create([
                'amount' => CardinityUtils::formatAmount($dAmount),
                'currency' => $oOrder->oxorder__oxcurrency->value,
                'settle' => true,
                'description' => $this->getConfig()->getActiveShop()->oxshops__oxname->value,
                'order_id' => $this->_getOrderId($oOrder),
                'country' => $this->getCountryCode($oOrder),
                'payment_method' => \Cardinity\Method\Payment\Create::CARD,
                'payment_instrument' => [
                    'pan' => $aPaymentInfoArr['ccnumber'],
                    'exp_year' => (int)$aPaymentInfoArr['ccyear'],
                    'exp_month' => (int)$aPaymentInfoArr['ccmonth'],
                    'cvc' => $aPaymentInfoArr['ccpruef'],
                    'holder' => $aPaymentInfoArr['ccname']
                ],
            ]);

            $this->responseData = $cardinity->call($payment);
            
            $this->_updateOrderTransaction($oOrder, $this->responseData, CardinityUtils::STATUS_OK);
            if ($this->responseData->getStatus() !== self::STATUS_APPROVED) {
                oxRegistry::getLang()->translateString('cardinity__PAYMENT_ERROR');
                return false;
            }

            return true;
        } catch (\Cardinity\Exception\Declined $e) {
            $this->_sLastError = oxRegistry::getLang()->translateString('cardinity__PAYMENT_DECLINED');
            $this->_updateOrderTransaction($oOrder, $e->getResult(), CardinityUtils::STATUS_FAILED);

            return false;
        } catch (Exception $e) {
            var_dump($e);exit;
            $this->_sLastError = oxRegistry::getLang()->translateString('cardinity__PAYMENT_EXCEPTION');
            return false;
        }
    }

    private function getCountryCode($oOrder)
    {
        $countryId = $oOrder->oxorder__oxbillcountryid->value;
        $oCountry = oxNew("oxcountry", "core");
        $oCountry->Load($countryId);

        return $oCountry->oxcountry__oxisoalpha2->value;
    }

    /**
     * Get credit card information
     *
     * @return array
     */
    private function _getPaymentInfo()
    {
        $aPaymentInfoArr = [];
        foreach ($this->_oPaymentInfo->_aDynValues as $obj) {
            $key = $obj->name;
            $value = $obj->value;
            $aPaymentInfoArr[$key] = $value;
        }

        return $aPaymentInfoArr;
    }

    /**
     * Do not store sensitive data in database
     */
    private function _clearSensitiveData()
    {
        $this->_oPaymentInfo->oxuserpayments__oxvalue->value = null;
        $this->_oPaymentInfo->_aDynValues = null;
        $this->_oPaymentInfo->save();
    }

    /**
     * Create order id
     *
     * @param oxOrder $oOrder
     * @return string
     */
    private function _getOrderId($oOrder)
    {
        return date('YmdHis', strtotime($oOrder->oxorder__oxorderdate->value));
    }

    /**
     * Update order with payment information
     *
     * @param oxOrder $oOrder
     * @param array $response
     * @param string $status
     */
    private function _updateOrderTransaction(&$oOrder, $response, $status)
    {
        $oOrder->oxorder__cardinity_status = new oxField($status);
        $oOrder->oxorder__cardinity_payment_type = new oxField($response->getType());
        $oOrder->oxorder__cardinity_id = new oxField($response->getId());
        $oOrder->oxorder__cardinity_response = new oxField(is_array($response) ? json_encode($response) : serialize($response));
        if ($status == CardinityUtils::STATUS_OK) {
            $oOrder->oxorder__oxpaid = new oxField(date('Y-m-d H:i:s'));
        }
        $oOrder->save();
    }
}
