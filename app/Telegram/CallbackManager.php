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
        Log::debug('CallbackManager resolve', ['result' => $this->callbacks[$name] ?? null, 'callbacks' => $this->callbacks]);
        return $this->callbacks[$name] ?? null;
    }
}
