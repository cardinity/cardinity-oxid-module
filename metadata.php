<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';

/**
 * Module information
 */
$aModule = [
    'id'           => 'cardinity-oxid-module',
    'title'        => 'Cardinity',
    'description'  => ['en' => 'Credit card payment option.'],
    'version'      => '1.0',
    'author'       => 'Cardinity',
    'email'        => 'info@cardinity.com',
    'url'          => 'https://github.com/cardinity/cardinity-oxid-module',
    'extend'        => [
        'oxpaymentgateway'  => 'cardinity-oxid-module/models/CardinityPaymentGateway',
        'oxviewconfig'      => 'cardinity-oxid-module/core/CardinityOxViewConfig',
        'order_overview'    => 'cardinity-oxid-module/controllers/admin/CardinityOrderOverview',
    ],
    'files'         => [
        'CardinityConfig'  => 'cardinity-oxid-module/controllers/admin/CardinityConfig.php',
        'CardinityUtils'  => 'cardinity-oxid-module/core/CardinityUtils.php',
    ],
    'blocks'       => [
        [
            'template'    => 'page/checkout/payment.tpl',
            'block'       => 'select_payment',
            'file'        => '/views/blocks/azure/page/checkout/payment/SelectPayment.tpl'
        ],
        [
            'template'    => 'page/checkout/payment.tpl',
            'block'       => 'checkout_payment_errors',
            'file'        => '/views/blocks/azure/page/checkout/payment/CheckoutPaymentError.tpl'
        ],
    ],
    'templates'     => [
        'CardinityConfig.tpl'  => 'cardinity-oxid-module/views/admin/tpl/CardinityConfig.tpl',
        'CardinityOrderOverview.tpl' => 'cardinity-oxid-module/views/admin/tpl/CardinityOrderOverview.tpl',
    ]
];
