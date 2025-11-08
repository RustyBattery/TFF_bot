<?php

namespace App\Telegram\Callbacks\Registration;

use App\Events\ChildRegistered;
use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ChildAreaApproveCallback extends Callback
{
    protected $name = 'child_area_approve';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'default');

        ChildRegistered::dispatch($user->children()->first());

        $this->replyWithMessage([
            'text' => "Данные успешно добавлены\\!\n\nПожалуйста, присоединитесь к родительскому чату по ссылке:\n\\<*ссылка на родительский чат*\\>",
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
