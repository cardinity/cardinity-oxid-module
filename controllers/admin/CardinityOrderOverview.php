<?php

require_once __DIR__.'/../../vendor/autoload.php';

class CardinityOrderOverview extends CardinityOrderOverview_parent
{
    /**
     * Render the template
     *
     * Renders Cardinity custom template for order overview after placing order in the shop.
     *
     * @extend render
     * @param
     * @return string
     */
    public function render()
    {
        $this->_aViewData['statusOk'] = CardinityUtils::STATUS_OK;
        $this->_aViewData['statusRefunded'] = CardinityUtils::STATUS_REFUNDED;
        $this->_aViewData['statusFailed'] = CardinityUtils::STATUS_FAILED;
        $this->_sThisTemplate = parent::render();
        $oOrder = oxNew("oxorder");
        $soxId = $this->getEditObjectId();

        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder->load($soxId);
            //payment method
            $payment_type = $oOrder->oxorder__oxpaymenttype->value;
            $this->_aViewData['paymentResponse'] = json_decode(str_replace('&quot;', '"', $oOrder->oxorder__cardinity_response->value), true);

            $this->_sThisTemplate = $this->getTemplate($payment_type, $this->_sThisTemplate);
        }

        return $this->_sThisTemplate;
    }

    /**
     * Returns custom template for orderoverview
     *
     * Returns Cardinity order overview template if the payment methods are cardinity payment method
     * else it returns base class templates .
     *
     * @param  string $payment_type
     * @param  string $parent
     * @return string
     */
    private function getTemplate($payment_type, $parent)
    {
        $sTemplate = $parent;
        if ($payment_type == 'cardinity') {
            $sTemplate = "CardinityOrderOverview.tpl";
        }

        return "CardinityOrderOverview.tpl";
    }

    /**
     * Refund action
     */
    public function refund()
    {
        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder = oxNew("oxorder");
            if ($oOrder->load($soxId)) {
                if ($oOrder->oxorder__cardinity_status->value == CardinityUtils::STATUS_OK &&
                        !empty($oOrder->oxorder__cardinity_id->value)) {
                    $this->cardinityRefund($oOrder);
                }
            }
        }
    }

    /**
     * Make refund using Cardinity lib
     *
     * @param type $oOrder
     * @return boolean
     */
    private function cardinityRefund(&$oOrder)
    {
        try {
            $viewConfig = oxRegistry::getConfig()->getTopActiveView()->getViewConfig();

            $cardinity = Cardinity\Client::create([
                'consumerKey' => $viewConfig->getCardinityConfigParam('consumerKey'),
                'consumerSecret' => $viewConfig->getCardinityConfigParam('consumerSecret'),
            ]);
            $refund = new Cardinity\Method\Refund\Create(
                $oOrder->oxorder__cardinity_id->value,
                CardinityUtils::formatAmount($oOrder->oxorder__oxtotalordersum->value),
                'refund'
            );

            $response = $cardinity->call($refund);

            $oOrder->oxorder__cardinity_refund_response = new oxField(serialize($response));
            $oOrder->oxorder__cardinity_refunded = new oxField(date('Y-m-d H:i:s'));
            $oOrder->oxorder__cardinity_status = new oxField(CardinityUtils::STATUS_REFUNDED);
            $oOrder->save();

            return true;

        } catch (Cardinity\Exception\Request $e) {
            $this->_aViewData["error"] = $e->getErrorsAsString();

            return false;
        } catch (Exception $e) {
            $this->_aViewData["error"] = $e->getMessage();

            return false;
        }
    }
}
