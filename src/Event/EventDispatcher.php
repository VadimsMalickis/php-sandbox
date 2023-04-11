<?php

declare(strict_types=1);

namespace App\Event;

class EventDispatcher
{
    private static EventDispatcher $eventDispatcher;

    /** @var array  */
    private array $observers = [];

    public function __construct()
    {
        $this->observers['*'] = [];
    }

    private function initEventGroup(string &$event = '*'): void
    {
        if (! isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    private function getEventObservers(string $event = '*'): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers['*'];

        return array_merge($group, $all);
    }

    public function attach(Observer $observer, string $event = '*'): void
    {
        $this->initEventGroup($event);
        $this->observers[$event][] = $observer;
    }

    public function detach(Observer $observer, string $event = '*'): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    public function trigger(string $event, object $emmiter, $data = null): void
    {
        echo "EventDispatcher: Broadcasting the '$event' event.\n";
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($event, $emmiter, $data);
        }
    }

    public static function getInstance(): EventDispatcher
    {
        if (! isset(self::$eventDispatcher)) {
            self::$eventDispatcher = new self();
            return self::$eventDispatcher;
        }
    }

}