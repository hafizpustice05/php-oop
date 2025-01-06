<?php

declare (strict_types = 1);

namespace App\PaymentGateway\Paddle;

use App\Enums\Status;
use InvalidArgumentException;

class Transaction
{
    private string $status;

    function __construct()
    {
        $this->setStatus(Status::STATUS_PENDING);
    }

    public function setStatus(string $status): self
    {
        if (! isset(Status::ALL_STATUSES[$status])) {
            throw new InvalidArgumentException('Status is not valid');
        }
        $this->status = $status;
        return $this;
    }
}
