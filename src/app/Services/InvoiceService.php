<?php

namespace App\Services;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayServiceInterface $gatewayService,
        protected EmailService $emailService,
    ) {

    }

    function process(array $customer, float $amount): bool
    {
        $tax = $this->salesTaxService->calculate($amount, $customer);

        //Process Invoice
        if (! $this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        echo 'Invoice service receipt processed.';
        //send receipnt
        $this->emailService->send($customer, 'receipt');
        return true;
    }

}
