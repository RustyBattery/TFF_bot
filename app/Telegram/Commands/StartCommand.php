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
                Keyboard::inlineButton(['text' => 'Кнопка 1', 'callback_data' => 'k1']),
                Keyboard::inlineButton(['text' => 'Кнопка 2', 'callback_data' => 'k2'])
            ])
            ->row(
                Keyboard::inlineButton(['text' => 'Кнопка 3', 'callback_data' => 'k3'])
            );


        $this->replyWithMessage([
            'text' => 'Добро пожаловать в онлайн запись!',
            'reply_markup' => $reply_markup
        ]);
    }
}
