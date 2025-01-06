<?php

namespace App\DebtCollector;

interface DebtCollector
{
    public function collect(float $ownedAmount): float;
}
