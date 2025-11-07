<?php

namespace App\Telegram\Commands;

use App\Telegram\Services\UserService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Главное меню';
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle()
    {
        $user = $this->userService->findUserByUpdate($this->getUpdate());
        $this->userService->resetState($user);

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Внести информацию о ребенке', 'callback_data' => 'registration'])
            ])
            ->row([
                Keyboard::inlineButton(['text' => 'Просмотр расписания', 'callback_data' => 'schedule'])
            ])
            ->row([
                Keyboard::inlineButton(['text' => 'Написать в поддержку', 'callback_data' => 'support'])
            ]);

        $this->replyWithMessage([
            'text' => 'Выберете действие:',
            'reply_markup' => $reply_markup
        ]);
    }
}
