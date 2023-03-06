<?php

namespace App;

use App\Exception\ContainerException;
use Psr\Container\ContainerInterface;

final class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            /** @var callable $entry */
            $entry = $this->entries[$id];
            return $entry($this);
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException('Class ' . $id . ' is not instantiable');
        }
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();

        if (!$parameters) {
            return new $id;
        }

        $dependencies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new ContainerException('Failed to resolve class ' . $id . ' because param ' . $name . ' is missing type hint');
            }
        }, $parameters);
        return $reflectionClass->newInstanceArgs($dependencies);

    }
}