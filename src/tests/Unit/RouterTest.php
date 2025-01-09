<?php

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    /** @test */
    public function it_registers_a_route(): void
    {
        // $router = new Router();

        $this->router->register('get', '/users', ['users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['users', 'index']
            ]
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_get_route(): void
    {
        // $router = new Router();

        $this->router->get('/users', ['users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['users', 'index']
            ]
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {
        // $router = new Router();

        $this->router->post('/users', ['users', 'store']);

        $expected = [
            'post' => [
                '/users' => ['users', 'store']
            ]
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function there_are_no_route_when_created_a_router(): void
    {
        $this->assertEmpty((new Router())->routes());
    }

//     /**
//      * @test
//      * @dataProvider routeNotFoundCases
//      *
//      */

//     public function it_throws_route_not_found_exception(
//         string $requestUri,
//         string $requestMethod
//     ): void {

//         $users = new class {
//             public function delete(): bool
//             {
//                 return true;
//             }
//         };
//         $this->router->post('/users', [$users::class, 'store']);
//         $this->router->get('/users', ['Users', 'index']);

//         $this->expectException(RouteNotFoundException::class);

//         $this->router->resolve($requestUri, $requestMethod);
//     }

//     public function routeNotFoundCases(): array
//     {
//         return [
//             ['/users', 'put'],
//             ['/invoices', 'post'],
//             ['/users', 'get'],
//             ['/users', 'get']
//         ];
//     }

    /**
     * @test
     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases()
     *
     */
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {

        $users = new class {
            public function delete(): bool
            {
                return true;
            }
        };
        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);

        $this->router->resolve($requestUri, $requestMethod);
    }

    /** @test */
    public function resolves_route_from_a_closure(): void
    {
        $this->router->get('/users', fn() => [1, 2, 3]);

        $this->assertEquals(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }

    /** @test */
    public function it_resolves_route(): void
    {

        $users = new class {
            public function get(): array
            {
                return [1, 2, 4];
            }
        };

        $this->router->get('/users', [$users::class, 'get']);

        $this->assertEquals([1, 2, 4],
            $this->router->resolve('/users', 'get'));

    }
}
