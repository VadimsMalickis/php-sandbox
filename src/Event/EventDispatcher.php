<?php

declare(strict_types=1);

namespace App\Event;

class EventDispatcher
{
    /** @var array  */
    private array $observers = [];

    /**
     *
     */
    public function __construct()
    {
        $this->observers['*'] = [];
    }

}