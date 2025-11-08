<?php

namespace App\Telegram\Callbacks\Support;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class SupportCallback extends Callback
{
    protected $name = 'support';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_support_request');

        $this->replyWithMessage([
            'text' => 'Введите текст обращения в поддержку:',
        ]);
    }
}
