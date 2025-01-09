<?php
namespace App\Exceptions;

class RouteNotFoundException extends \Exception
{
    public $message = '404 not found';
}
