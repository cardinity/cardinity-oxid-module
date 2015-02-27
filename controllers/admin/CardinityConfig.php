<?php

class CardinityConfig extends Shop_Config {

    /**
     * class template.
     * @var string
     */
    protected $_sThisTemplate = 'CardinityConfig.tpl';

    /**
     * @extend render
     * @return string
     */
    public function render() {
        $this->_aViewData['cardinityConfig'] = $this->getConfig()->getShopConfVar('cardinityConfig');
        return $this->_sThisTemplate;
    }

    /**
     * @extend save
     * @return void
     */
    public function save() {
        $oxConfig = $this->getConfig();
        $cardinityConfig = $oxConfig->getRequestParameter('cardinityConfig');
        $oxConfig->saveShopConfVar('arr', 'cardinityConfig', $cardinityConfig);
    }

}