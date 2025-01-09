<?php
namespace App\Exceptions;

class ViewNotFoundException extends \Exception
{
    public $message = 'View not found exception.';
}
