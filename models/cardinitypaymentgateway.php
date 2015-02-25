<?php

require_once __DIR__.'/../vendor/autoload.php';

class cardinityPaymentGateway extends cardinityPaymentGateway_parent {

  protected $_blActive = true;
    
  protected $consumerKey = 'test_xfthl9u8crukjzigvh2962tnce96ok';
  protected $consumerSecret = '8jppkz7cu8sr0z8m7zd1lqsvho20osd14vkkokvbjsrqn5z43m';
  
  protected $sTestMode = true;
  
  public function executePayment($dAmount, &$oOrder) {

    if ($this->_oPaymentInfo->oxuserpayments__oxpaymentsid->value != 'cardinity') {
        return parent::executePayment($dAmount, $oOrder);    
    }
    $this->_iLastErrorNo = null;
    $this->_sLastError = null;
        
    try {
      
      // get payment information
      // convert payment information into array for easier access
      $aPaymentInfoArr = array();    
      foreach ($this->_oPaymentInfo->_aDynValues as $obj) {
        $key = $obj->name;
        $value = $obj->value;
        $aPaymentInfoArr[$key] = $value;
      }
      
      // get user information
      $sUserID = $this->getSession()->getVariable("usr");
      $oUser = &oxNew("oxuser", "core");
      $oUser->Load($sUserID);  

      $cardinity = \Cardinity\Client::create(array(
          'consumerKey' => $this->consumerKey,
          'consumerSecret' => $this->consumerSecret,
      ));

      $payment = new \Cardinity\Payment\Create(array(
            'amount' => $dAmount,
            'currency' => 'EUR',
            'settle' => false,
            'description' => $this->getConfig()->getActiveShop()->oxshops__oxname->value,
            'order_id' => $oOrder->oxorder__oxorderdate->value,
            'country' => 'LT',
            'payment_method' => \Cardinity\Payment\Create::CARD,
            'payment_instrument' => [
                'pan' => $aPaymentInfoArr['kknumber'],
                'exp_year' => $aPaymentInfoArr['kkyear'],
                'exp_month' => $aPaymentInfoArr['kkmonth'],
                'cvc' => $aPaymentInfoArr['kkpruef'],
                'holder' => $aPaymentInfoArr['kkname']
            ],
      ));
      
      $this->responseData = $cardinity->get($payment);
      var_dump($this->responseData);die;
      
    } catch (Exception $e) {
      $this->_sLastError = $e->getMessage();
      return false;
    }    
  }
  
}
?>