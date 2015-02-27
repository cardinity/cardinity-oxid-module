<?php

class CardinityUtils
{
    const STATUS_OK = 'OK';
    const STATUS_FAILED = 'FAILED';
    const STATUS_REFUNDED = 'REFUNDED';

    public static function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }
}
