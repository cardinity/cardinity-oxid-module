<?php

class cardinity__config extends Shop_Config {

    /**
     * class template.
     * @var string
     */
    protected $_sThisTemplate = 'cardinity__config.tpl';

    /**
     * @extend render
     * @return string
     */
    public function render() {
        $this->_aViewData['cardinity_config'] = $this->getConfig()->getShopConfVar('cardinity_config');
        return $this->_sThisTemplate;
    }

    /**
     * @extend save
     * @return void
     */
    public function save() {
        $oxConfig = $this->getConfig();
        $cardinityConfig = $oxConfig->getRequestParameter('cardinity_config');
        $oxConfig->saveShopConfVar('arr', 'cardinity_config', $cardinityConfig);
    }

}