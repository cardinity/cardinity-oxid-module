<?php

class CardinityRedirect extends oxUBase {

    /**
     * @var string template name
     */
    protected $_sThisTemplate = 'CardinityRedirect.tpl';

    /**
     * Assign Required Params
     *
     * Assign all the params required by Cardinity 3D-secure.
     *
     * @extend Render
     * @param none
     *
     * @return string template
     */
    public function render() {

        parent::render();

        $oxSession = oxRegistry::getSession();
        if ($oxSession->getVariable('cardinity_redirect_data')) {
            $redirectData = $oxSession->getVariable('cardinity_redirect_data');
            $this->_aViewData['formAction'] = $redirectData['url'];
            $this->_aViewData['data'] = $redirectData['data'];
            $this->_aViewData['callbackUrl'] = $redirectData['callbackUrl'];
            $this->_aViewData['identifier'] = $redirectData['identifier'];
        }

        return $this->_sThisTemplate;
    }

}