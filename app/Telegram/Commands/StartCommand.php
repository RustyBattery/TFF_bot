<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Начало работы с ботом';

    public function handle()
    {
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
