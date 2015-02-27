<?php

require_once __DIR__ . '/../vendor/autoload.php';

class CardinityPaymentGateway extends CardinityPaymentGateway_parent
{
    
    /**
     * Executes Cardinity payment after order confirmation
     * 
     * @param float $dAmount
     * @param oxOrder $oOrder
     * @return boolean
     */
    public function executePayment($dAmount, &$oOrder)
    {
        if ($this->_oPaymentInfo->oxuserpayments__oxpaymentsid->value != 'cardinity') {
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

            $payment = new \Cardinity\Payment\Create([
                'amount' => CardinityUtils::formatAmount($dAmount),
                'currency' => 'EUR',
                'settle' => true,
                'description' => $this->getConfig()->getActiveShop()->oxshops__oxname->value,
                'order_id' => $this->_getOrderId($oOrder),
                'country' => 'LT',
                'payment_method' => \Cardinity\Payment\Create::CARD,
                'payment_instrument' => [
                    'pan' => $aPaymentInfoArr['ccnumber'],
                    'exp_year' => $aPaymentInfoArr['ccyear'],
                    'exp_month' => $aPaymentInfoArr['ccmonth'],
                    'cvc' => $aPaymentInfoArr['ccpruef'],
                    'holder' => $aPaymentInfoArr['ccname']
                ],
            ]);

            $this->responseData = $cardinity->get($payment);

            $this->_updateOrderTransaction($oOrder, $this->responseData, CardinityUtils::STATUS_OK);

            return true;
        } catch (\Cardinity\Exception\RequestFailed $e) {

            $this->_updateOrderTransaction($oOrder, $e->getResponseData(), CardinityUtils::STATUS_FAILED);

            return true;
        } catch (Exception $e) {

            $this->_sLastError = $e->getMessage();

            return false;
        }
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
        $oOrder->oxorder__cardinity_payment_type = new oxField($response['type']);
        $oOrder->oxorder__cardinity_id = new oxField($response['id']);
        $oOrder->oxorder__cardinity_response = new oxField(json_encode($response));
        $oOrder->oxorder__oxpaid = new oxField(date('Y-m-d H:i:s'));
        $oOrder->save();
    }

}
