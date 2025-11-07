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
        $this->userService->resetState($user);

        $this->replyWithMessage([
            'text' => 'Позже здесь будет доступно обращение в поддержку'
        ]);
    }
}
