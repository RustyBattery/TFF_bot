<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class InfoCommand extends Command
{
    protected string $name = 'info';
    protected string $description = 'Моя информация';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь можно будет посмотреть введенную информацию о ребенке',
        ]);
    }
}
