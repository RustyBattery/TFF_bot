<?php

namespace App\Telegram\Callbacks\Schedule;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ScheduleCallback extends Callback
{
    protected $name = 'schedule';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->resetState($user);

        $this->replyWithMessage([
            'text' => 'Позже здесь будет доступен просмотр расписания'
        ]);
    }
}
