<?php

namespace App\Telegram\Callbacks\Schedule;

use App\Telegram\Callbacks\Callback;

class ScheduleCallback extends Callback
{
    protected $name = 'schedule';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь будет доступен просмотр расписания'
        ]);
    }
}
