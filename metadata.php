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
    'extend'        => array(
        'payment'           => 'cardinity/controllers/cardinitypayment',
        'oxpaymentgateway'  => 'cardinity/models/cardinitypaymentgateway',
        'oxviewconfig'      => 'cardinity/core/cardinityoxviewconfig',
        'order_overview'    => 'cardinity/controllers/admin/cardinityorderoverview',
    ),
    'files'         => array(
        'cardinity__config'  => 'cardinity/controllers/admin/cardinity__config.php',
        'cardinityutils'  => 'cardinity/core/cardinityutils.php',
    ),
    'blocks'       => array(
        array('template'    => 'page/checkout/payment.tpl',
              'block'       => 'select_payment',
              'file'        => '/views/blocks/azure/page/checkout/payment/select_payment.tpl'),
    ),
    'templates'     => array(
        'cardinity__config.tpl'  => 'cardinity/views/admin/tpl/cardinity__config.tpl',
        'cardinityorderoverview.tpl' => 'cardinity/views/admin/tpl/cardinityorderoverview.tpl',
    )
    );

?>
