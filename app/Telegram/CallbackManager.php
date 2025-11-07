<?php

namespace App\Telegram;

use App\Telegram\Callbacks\Callback;
use Illuminate\Support\Facades\Log;

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
        foreach ($this->callbacks as $callback) {
            if ($callback->match($name)) {
                return $callback;
            }
        }
        return null;
    }
}
