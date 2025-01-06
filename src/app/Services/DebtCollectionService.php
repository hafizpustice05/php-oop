<?php

namespace App\Services;

use App\DebtCollector\DebtCollector;

class DebtCollectionService
{
    public function collectDebt(DebtCollector $collector)
    {
        $ownedAmount     = mt_rand(100, 1000);
        $collectedAmount = $collector->collect($ownedAmount);

        echo 'Collected $' . $collectedAmount . ' out of $' . $ownedAmount;
    }
}
