<?php

class CardinityOrder extends CardinityOrder_parent {

    /**
     * handles response from payment-gateway
     * @return type
     */
    public function cardinity_gateway_return() {
        $_POST['stoken'] = isset($_POST['MD']) ? $_POST['MD'] : null;
        $_POST['sDeliveryAddressMD5'] = $this->getDeliveryAddressMD5();
        $_POST['actcontrol'] = oxRegistry::getConfig()->getTopActiveView()->getViewConfig()->getTopActiveClassName();

        return $this->execute();
    }
}