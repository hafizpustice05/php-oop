<?php
namespace App\Controller;

use App\View\View;

class InvoiceController
{

    public function index(): View
    {
        unset($_SESSION['count']);
        return View::make('invoices/index');
    }

    function create(): View
    {
        return View::make('invoices/create');

    }

    function store()
    {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
    }
}
