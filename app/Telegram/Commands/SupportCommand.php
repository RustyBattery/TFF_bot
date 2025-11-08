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
        $this->userService->setState($user, 'waiting_support_request');

        $this->replyWithMessage([
            'text' => 'Введите текст обращения в поддержку:',
        ]);
    }
}
