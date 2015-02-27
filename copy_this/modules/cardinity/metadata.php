<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';

/**
 * Module information
 */
$aModule = [
    'id'           => 'cardinity',
    'title'        => 'Cardinity',
    'description'  => ['en' => 'Credit card payment option.'],
    'version'      => '1.0',
    'author'       => 'Paulius Podolskis',
    'email'        => 'paulius.b@estina.lt',
    'extend'        => [
        'oxpaymentgateway'  => 'cardinity/models/CardinityPaymentGateway',
        'oxviewconfig'      => 'cardinity/core/CardinityOxViewConfig',
        'order_overview'    => 'cardinity/controllers/admin/CardinityOrderOverview',
    ],
    'files'         => [
        'CardinityConfig'  => 'cardinity/controllers/admin/CardinityConfig.php',
        'CardinityUtils'  => 'cardinity/core/CardinityUtils.php',
    ],
    'blocks'       => [
        ['template'    => 'page/checkout/payment.tpl',
              'block'       => 'select_payment',
              'file'        => '/views/blocks/azure/page/checkout/payment/SelectPayment.tpl'],
        ['template'    => 'page/checkout/payment.tpl',
              'block'       => 'checkout_payment_errors',
              'file'        => '/views/blocks/azure/page/checkout/payment/CheckoutPaymentError.tpl'],
    ],
    'templates'     => [
        'CardinityConfig.tpl'  => 'cardinity/views/admin/tpl/CardinityConfig.tpl',
        'CardinityOrderOverview.tpl' => 'cardinity/views/admin/tpl/CardinityOrderOverview.tpl',
    ]
    ];
