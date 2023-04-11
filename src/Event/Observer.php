<?php

namespace App\Event;

interface Observer
{
    public function update(string $event, object $emmiter, $data = null);
}