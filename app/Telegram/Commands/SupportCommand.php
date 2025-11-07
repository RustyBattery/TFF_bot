<?php

namespace App\Telegram\Commands;

use App\Telegram\Services\UserService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class SupportCommand extends Command
{
    protected string $name = 'support';
    protected string $description = 'Поддержка';
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle()
    {
        $user = $this->userService->findUserByUpdate($this->getUpdate());
        $this->userService->resetState($user);

        $this->replyWithMessage([
            'text' => 'Позже здесь можно будет оставить обращение в поддержку',
        ]);
    }
}
