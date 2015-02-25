<?php

class cardinityPayment extends cardinityPayment_parent {

    public function render() {
        $oUser = $this->getUser();
//        if ($oUser) {
//            if (!oxSession::hasVar('nngust'))
//                oxSession::setVar('nngust', $oUser->oxuser__oxid->value);
//
//            if (oxSession::getVar('nngust') != $oUser->oxuser__oxid->value) {
//                /* Register guest unset */
//                oxSession::deleteVar('nngust');
//                oxSession::deleteVar("dynvalue");
//            }
//        }

        return parent::render();
    }

    /**
     * Assign to get dynvalues
     *
     * Assign Novalnet Payment types to get dynamic values like userdata etc from views.
     *
     * @extend Dynvalues
     * @param
     * @return array
     */
    public function getDynValue() {
        parent::getDynValue();
        $aPaymentList = parent::getPaymentList();
	$result = isset($aPaymentList['novalnetsepa']) ? $this->_assignDebitNoteParams():'';
        
        return $this->_aDynValue;
    }

    /**
     * Assign params
     *
     * Assign Novalnet Payment types params in instance.
     *
     * @extend Dynvalues
     * @param None
     *
     */
    protected function _assignDebitNoteParams() {
        parent::_assignDebitNoteParams();
        $oUserPayment = oxNew('oxuserpayment');

        if ($oUserPayment->getPaymentByPaymentType($this->getUser(), 'novalnetsepa')) {
            $aAddPaymentData = oxUtils::getInstance()->assignValuesFromText($oUserPayment->oxuserpayments__oxvalue->value);

            //check values is already set
            $this->_checkPaymentData($aAddPaymentData);
        }
    }

    /**
     * Assigns payment data to $this->_aDynValue
     *
     * @param None
     */
    private function _checkPaymentData($aAddPaymentData) {
        foreach ($aAddPaymentData as $oData) {
            if (!isset($this->_aDynValue[$oData->name]) ||
                    ( isset($this->_aDynValue[$oData->name]) && !$this->_aDynValue[$oData->name] )) {
                $this->_aDynValue[$oData->name] = $oData->value;
            }
        }
    }

}