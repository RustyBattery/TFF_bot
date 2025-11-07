<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ChildNameApproveCallback extends Callback
{
    protected $name = 'child_name_approve';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_birthdate');

        $this->replyWithMessage([
            'text' => "Введите дату рождения ребенка в формате *дд.мм.гггг*",
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
