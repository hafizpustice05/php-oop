<?php

namespace App\Container;

use App\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable | string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function entry()
    {
        return $this->entries;

    }

    public function resolve(string $id)
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new ReflectionClass($id);

        if (! $reflectionClass->isInstantiable()) {
            throw new ContainerException('class"' . $id . '" is not instantiable.');
        }

        // 2. Inspect the constructor of this class
        $constructor = $reflectionClass->getConstructor();

        if (! $constructor) {
            // $this->entries[$id] = new $id;

            return new $id;
        }

        // 3. Inspect the constructor parameters (dependencises)
        $parameters = $constructor->getParameters();

        // 4.  If the constructor paramerter is a class then try to resolve the class uning the container

        $dependencies = array_map(
            function (ReflectionParameter $params) use ($id) {
                $name = $params->getName();
                $type = $params->getType();

                if (! $type) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because param "' . $name . '"is missing of type hint.'
                    );
                }

                if ($type instanceof ReflectionUnionType) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"is missing of type hint.'
                    );
                }

                if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
                    return $this->get($type->getName());
                }

                throw new ContainerException(
                    'Failed to resolve class "' . $id . '" because invalid param "' . $name . '".'
                );

            }, $parameters);
        // $this->entries[$id] = $reflectionClass->newInstanceArgs($dependencies);

        return $reflectionClass->newInstanceArgs($dependencies);

    }

    // public function getContainer()
    // {
    //     return $this->entries;
    // }
}
