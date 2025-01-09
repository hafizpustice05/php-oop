<?php

namespace App\Config;

/**
 * @property-read ?array $db
 */

class Config
{
    protected array $config;

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host'     => $_ENV['DB_HOST'],
                'database' => $_ENV['DATABASE_NAME'],
                'user'     => $_ENV['DB_USER'],
                'pass'     => $_ENV['DB_PASSWORD'],
                'driver'   => $_ENV['DB_DRIVER'] ?? 'mysql'
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name];
    }
}
