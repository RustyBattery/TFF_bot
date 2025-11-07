<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class RegisterCallback extends Callback
{
    protected $name = 'registration';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_child_name');

        $this->replyWithMessage([
            'text' => 'Введите ФИО ребенка'
        ]);
    }
}
