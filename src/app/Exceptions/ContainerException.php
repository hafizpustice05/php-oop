<?php
namespace App\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class ContainerException extends \Exception implements NotFoundExceptionInterface
{
    public $message = '404 not found';
}
