<?php

namespace App\Bootstrap;

use PDO;

/**
 * @mixin \PDO
 */
class DB
{
    public PDO $pdo;

    public function __construct($config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions
            );

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }

    }

    public function __call(string $name, array $arguments = [])
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

}
