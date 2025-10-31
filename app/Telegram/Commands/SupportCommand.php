<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class SupportCommand extends Command
{
    protected string $name = 'support';
    protected string $description = 'Поддержка';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь можно будет оставить обращение в поддержку',
        ]);
    }
}
