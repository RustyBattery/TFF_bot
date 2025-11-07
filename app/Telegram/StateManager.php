<?php

namespace App\Telegram;

use App\Telegram\States\State;

class StateManager
{
    protected array $states = [];

    public function register(string $class): void
    {
        /** @var State $state */
        $state = app($class);
        $this->states[$state->getName()] = $state;
    }

    public function resolve(string $name): ?State
    {
        return $this->states[$name] ?? null;
    }
}
