<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ChildNameResetCallback extends Callback
{
    protected $name = 'child_name_reset';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_child_name');
        $user->children()->first()->name = '';

        $this->replyWithMessage([
            'text' => 'Введите ФИО ребенка'
        ]);
    }
}
