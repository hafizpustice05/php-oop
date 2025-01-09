<?php

declare (strict_types = 1);

use App\Bootstrap\App;
use App\Config\Config;
use App\Container\Container;

define('VIEW_PATH', __DIR__ . '/../views');

/**
 * no need this as using autolaod
 * require_once '../app/PaymentGateway/Stripe/Transaction.php';
 *spl_autoload_register(function ($class) {
 *    $path = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';
 *    require $path;
 *});
 */

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = new Container;
$router    = new \App\Router\Router($container);

session_start();

$router->get('/', [\App\Controller\HomeController::class, 'index']);
$router->get('/invoice', [\App\Controller\InvoiceController::class, 'index']);
$router->get('/invoice/create', [\App\Controller\InvoiceController::class, 'create']);
$router->post('/invoice/create', [\App\Controller\InvoiceController::class, 'store']);

(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    (new Config($_ENV))
))->run();

// use App\PaymentGateway\Paddle\Transaction;
// use App\PaymentGateway\Stripe\Transaction as StripeTransaction;
// $transaction = new Transaction;

// $id = new \Ramsey\Uuid\UuidFactory();
// // echo $id->uuid4();

// $fields = [
//     new \App\Html\From\Text('TextFiled'),
//     new \App\Html\From\Checkbox('BaseFiled'),
//     new \App\Html\From\Radio('BaseFiled')
// ];

// foreach ($fields as $field) {
//     echo $field->render() . '</br>';
// }

// $collector = new App\DebtCollector\CollectionAgency();

// echo $collector->collect(100) . PHP_EOL;
// var_dump($collector);

// $colelctionService = new App\Services\DebtCollectionService();

// echo PHP_EOL;
// echo $colelctionService->collectDebt(new App\DebtCollector\Rocky()) . PHP_EOL;

// foreach (new StripeTransaction(25, 'sh') as $key => $value) {
//     echo $key . ' - ' . $value . PHP_EOL;
// }

// $invoiceCollections = new \App\Collection\InvoiceCollection(
//     [
//         new StripeTransaction(25, 'sh'),
//         new StripeTransaction(25, 'sh')
//     ]
// );

// foreach ($invoiceCollections as $key) {
//     echo $key->amount . PHP_EOL;
// }

// echo '------------------' . PHP_EOL;
// init($invoiceCollections);
// function init(\App\Collection\Collection $iterate)
// {
//     foreach ($iterate as $key => $item) {
//         echo 'Amount: ' . $item->amount . ' Description: ' . $item->description . PHP_EOL;

//     }
// }

// echo '<pre>';
// print_r($_ENV);
// echo '</pre>';
