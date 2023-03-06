<?php

namespace App;

use App\Exception\Container\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Class "' . $id . '" has no binding.');
        }
        $entry = $this->entries[$id];
        return $entry($this);
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }
}