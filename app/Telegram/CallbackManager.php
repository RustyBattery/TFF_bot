<?php

namespace App\Telegram;

use App\Telegram\Callbacks\Callback;

class CallbackManager
{
    protected array $callbacks = [];

    public function register(string $class): void
    {
        /** @var Callback $callback */
        $callback = app($class);
        $this->callbacks[$callback->getName()] = $callback;
    }

    public function resolve(string $name): ?Callback
    {
        return $this->callbacks[$name] ?? null;
    }
}
