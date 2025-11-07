<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ChildBirthdateResetCallback extends Callback
{
    protected $name = 'child_birthdate_reset';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_child_birthdate');

        $child = $user->children()->first();
        $child->birthdate = null;
        $child->save();

        $this->replyWithMessage([
            'text' => "Введите дату рождения ребенка в формате *дд\\.мм\\.гггг*",
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
