<?php

namespace App\DebtCollector;

class CollectionAgency implements DebtCollector, \Stringable
{
    public function collect(float $ownedAmount): float
    {
        $guarantedAmount = $ownedAmount * 0.5;
        return mt_rand($guarantedAmount, $ownedAmount);
    }

    public function __toString(): string
    {
        return 'CollectiuonAgency';
    }
}
