<?php

class cardinityPayment extends cardinityPayment_parent {

    public function render() {

        return parent::render();
    }

    /**
     * Assign to get dynvalues
     *
     * Assign Cardinity Payment type to get dynamic values like userdata etc from views.
     *
     * @extend Dynvalues
     * @param
     * @return array
     */
    public function getDynValue() {
        parent::getDynValue();
        $aPaymentList = parent::getPaymentList();
	$result = isset($aPaymentList['cardinity']) ? $this->_assignParams():'';
        
        return $this->_aDynValue;
    }

    /**
     * Assign params
     *
     * Assign Cardinity Payment type params in instance.
     *
     * @extend Dynvalues
     * @param None
     *
     */
    protected function _assignParams() {
        parent::_assignDebitNoteParams();
        $oUserPayment = oxNew('oxuserpayment');

        if ($oUserPayment->getPaymentByPaymentType($this->getUser(), 'cardinity')) {
            $oxUtils = new oxUtils();
            $aAddPaymentData = $oxUtils->assignValuesFromText($oUserPayment->oxuserpayments__oxvalue->value);
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