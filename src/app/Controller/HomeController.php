<?php
namespace App\Controller;

use App\Bootstrap\App;
use App\Models\User;
use App\Services\InvoiceService;
use App\View\View;

class HomeController
{

    public function __construct(private InvoiceService $invoiceService)
    {

    }

    public function index(): View
    {
        $users = (new User())->find();

        // (new Container())->get(InvoiceService::class)->process([], 25);
        $this->invoiceService->process([], 25);

        // return exit;

        foreach ($users as $row) {

            echo '<pre>';
            var_dump($row);
            echo '</pre>';
        }
        $_SESSION['count'] = ($_SESSION['count']) + 1;

        setcookie(
            'user',
            'hafiz',
            time() + 10
        );

        return View::make('index', $_GET);
    }
}
