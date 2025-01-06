<?php

namespace App\DebtCollector;

class Rocky implements DebtCollector
{
    public function collect(float $ownedAmount): float
    {
        $guarantedAmount = $ownedAmount * 0.65;
        return mt_rand($guarantedAmount, $ownedAmount);
    }
}
