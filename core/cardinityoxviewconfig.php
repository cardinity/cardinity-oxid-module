<?php

class cardinityOxViewConfig extends cardinityOxViewConfig_parent {

    /**
     * var array
     */
    private $_aCardinityConfig;

    /**
     * Set the Cardinity configuration
     *
     * @return array
     */
    public function setCardinityConfig() {
        $this->_aCardinityConfig = $this->getConfig()->getConfigParam('cardinity_config');
        if (is_array($this->_aCardinityConfig)) {
            $this->_aCardinityConfig = array_map("trim", $this->_aCardinityConfig);
        }

        return $this->_aCardinityConfig;
    }

    /**
     * Getter for Cardinity config
     *
     * @return mixed
     */
    public function getCardinityConfigParam($config) {

        $this->setCardinityConfig();

        return isset($this->_aCardinityConfig[$config]) ? $this->_aCardinityConfig[$config] : NULL;
    }

    /**
     * Set the payment field value
     *
     * @param $aDynName
     * @return mixed
     */
    public function getPaymentFieldValue($aDynName) {

        $aDynvalues = oxSession::getVar("dynvalue");
        return $aDynvalues[$aDynName];
    }

}