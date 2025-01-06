<?php

namespace App\Enums;

class Status
{
    public const STATUS_PAID     = 'Paid';
    public const STATUS_PENDING  = 'Pending';
    public const STATUS_DECLINED = 'Declined';

    public const ALL_STATUSES = [
        self::STATUS_PAID     => 'Paid',
        self::STATUS_PENDING  => 'Pending',
        self::STATUS_DECLINED => 'Declined'
    ];
}
