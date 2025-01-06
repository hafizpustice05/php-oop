<?php

declare (strict_types = 1);

/**
 * no need this as using autolaod
 * require_once '../app/PaymentGateway/Stripe/Transaction.php';
 *spl_autoload_register(function ($class) {
 *    $path = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';
 *    require $path;
 *});
 */

require __DIR__ . '/../vendor/autoload.php';

use App\PaymentGateway\Paddle\Transaction;

$transaction = new Transaction;

$id = new \Ramsey\Uuid\UuidFactory();
// echo $id->uuid4();

$fields = [
    new \App\Html\From\Text('TextFiled'),
    new \App\Html\From\Checkbox('BaseFiled'),
    new \App\Html\From\Radio('BaseFiled')
];

foreach ($fields as $field) {
    echo $field->render() . '</br>';
}

$collector = new App\DebtCollector\CollectionAgency();

echo $collector->collect(100) . PHP_EOL;
var_dump($collector);

$colelctionService = new App\Services\DebtCollectionService();

echo PHP_EOL;
echo $colelctionService->collectDebt(new App\DebtCollector\Rocky());
