<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class ScheduleCommand extends Command
{
    protected string $name = 'schedule';
    protected string $description = 'Расписание';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь можно будет просмотреть расписание занятий по районам',
        ]);
    }
}
