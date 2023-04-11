<?php

declare(strict_types=1);

namespace App\Repository;

use App\Event\EventDispatcher;
use App\Event\Observer;

class UserRepository implements Observer
{
    private array $users = [];

    /**
     * @param array $users
     */
    public function __construct()
    {
        EventDispatcher::getInstance()->attach($this, 'users:deleted');
    }


    public function update(string $event, object $emitter, $data = null): void
    {
        switch ($event) {
            case "users:deleted":
                if ($emitter === $this) {
                    return;
                }
                $this->deleteUser($data, true);
                break;
        }
    }

    public function initialize(string $filename): void
    {
        echo "UserRepository: Loading user records from a file.\n";
        // ...
        EventDispatcher::getInstance()->trigger("users:init", $this, $filename);
    }

    public function createUser(array $data, bool $silent = false): User
    {
        echo "UserRepository: Creating a user.\n";

        $user = new User();
        $user->update($data);

        $id = bin2hex(random_bytes(10));
        $user->update(["id" => $id]);
        $this->users[$id] = $user;

        if (!$silent) {
            EventDispatcher::getInstance()->trigger("users:created", $this, $user);
        }

        return $user;
    }

    public function updateUser(User $user, array $data, bool $silent = false): ?User
    {
        echo "UserRepository: Updating a user.\n";

        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return null;
        }

        $user = $this->users[$id];
        $user->update($data);

        if (!$silent) {
            EventDispatcher::getInstance()->trigger("users:updated", $this, $user);
        }

        return $user;
    }

    public function deleteUser(User $user, bool $silent = false): void
    {
        echo "UserRepository: Deleting a user.\n";

        $id = $user->attributes["id"];
        if (!isset($this->users[$id])) {
            return;
        }

        unset($this->users[$id]);

        if (!$silent) {
           EventDispatcher::getInstance()->trigger("users:deleted", $this, $user);
        }
    }

}