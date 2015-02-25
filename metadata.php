<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'cardinity',
    'title'        => 'Cardinity',
    'description'  => array('en' => 'Credit card payment option.'),
    'version'      => '1.0',
    'author'       => 'Paulius Podolskis',
    'email'        => 'paulius.b@estina.lt',
    'extend'       => array(),
    'files'        => array('cardinity' => 'cardinity/admin/cardinity.php'),
    'templates'    => array('cardinity.tpl' => 'cardinity/out/admin/tpl/cardinity.tpl'),
    'extend'        => array(
        'payment'           => 'cardinity/controllers/cardinitypayment',
        'oxpaymentgateway'  => 'cardinity/models/cardinitypaymentgateway',
    ),
    'blocks'       => array(
        array('template'    => 'page/checkout/payment.tpl',
              'block'       => 'select_payment',
              'file'        => '/views/blocks/azure/page/checkout/payment/select_payment.tpl'),
    )
    );

?>
