<?php

require_once __DIR__.'/../../vendor/autoload.php';

class cardinityOrderOverview extends cardinityOrderOverview_parent {

    /**
     * Render the template
     *
     * Renders Cardinity custom template for order overview after placing order in the shop.
     *
     * @extend render
     * @param
     * @return string
     */
    public function render() {
        $this->_aViewData['statusOK'] = CardinityUtils::STATUS_OK;
        $this->_sThisTemplate = parent::render();
        $oOrder = oxNew("oxorder");
        $soxId = $this->getEditObjectId();

        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder->load($soxId);
            //payment method
            $payment_type = $oOrder->oxorder__oxpaymenttype->value;

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
     * @extend render
     * @param  string $payment_type
     * @param  string $parent
     * @return string
     */
    private function getTemplate($payment_type, $parent) {
        $sTemplate = $parent;
        if ($payment_type == 'cardinity') {
            $sTemplate = "cardinityorderoverview.tpl";
        }
        return $sTemplate;
    }

    public function cardinityRefund() {
        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oOrder = oxNew("oxorder");
            if ($oOrder->load($soxId)) {
                if ($oOrder->oxorder__cardinity_status->value == CardinityUtils::STATUS_OK &&
                        !empty($oOrder->oxorder__cardinity_id->value)) {
                    $this->refund($oOrder);
                }
            }
        }
    }

    private function refund(&$oOrder) {
        try {
            $viewConfig = oxRegistry::getConfig()->getTopActiveView()->getViewConfig();

            $cardinity = Cardinity\Client::create(array(
                        'consumerKey' => $viewConfig->getCardinityConfigParam('consumerKey'),
                        'consumerSecret' => $viewConfig->getCardinityConfigParam('consumerSecret'),
            ));
            $refund = new Cardinity\Refund\Create(
                    $oOrder->oxorder__cardinity_id->value, 
                    CardinityUtils::formatAmount($oOrder->oxorder__oxtotalordersum->value), 
                    'refund'
            );

            $response = $cardinity->get($refund);

            $oOrder->oxorder__cardinity_refund_response = new oxField(json_encode($response));
            $oOrder->oxorder__cardinity_status = new oxField(CardinityUtils::STATUS_REFUNDED);
            $oOrder->save(); 
        
            return true;
        
        } catch (Cardinity\Exception\BadRequest $e){
            $msg = isset($e->getResponseData()['errors'][0]['message']) ? $e->getResponseData()['errors'][0]['message'] : $e->getMessage();
            $this->_aViewData["error"] = $msg;
            return false;
        } catch (Exception $e) {
            $this->_aViewData["error"] = $e->getMessage();
            return false;
        }
    }

}
