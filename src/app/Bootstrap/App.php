<?php

namespace App\Bootstrap;

use App\Config\Config;
use App\Container\Container;
use App\Exceptions\RouteNotFoundException;
use App\Router\Router;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayServiceInterface;

class App
{
    private static DB $db;
    // public static Container $container;

    public function __construct(
        protected Container $container,
        protected Router $router,
        protected array $request,
        protected Config $config
    ) {
        static::$db = new DB($config->db ?? []);
        // static::$container = new Container();

        // $this->container->set(
        //     PaymentGatewayServiceInterface::class,
        //     fn(Container $c) => $c->get(PaymentGatewayService::class)
        // );

        $this->container->set(PaymentGatewayServiceInterface::class, PaymentGatewayService::class);

        // static::$container->set(InvoiceService::class,
        //     function (Container $c) {
        //         return new InvoiceService(
        //             $c->get(SalesTaxService::class),
        //             $c->get(PaymentGatewayService::class),
        //             $c->get(EmailService::class),
        //         );
        //     });

        // // echo '<pre>';

        // // var_dump(static::$container->entry());
        // // echo '</pre>';

        // static::$container->set(SalesTaxService::class, fn() => new SalesTaxService);
        // static::$container->set(PaymentGatewayService::class, fn() => new PaymentGatewayService);
        // static::$container->set(EmailService::class, fn() => new EmailService);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    function run()
    {
        try {

            echo $this->router->resolve(
                $this->request['uri'],
                strtolower($this->request['method'])
            );
        } catch (RouteNotFoundException $e) {
            http_response_code(404);

            echo $e->getMessage();
        }
    }
}
