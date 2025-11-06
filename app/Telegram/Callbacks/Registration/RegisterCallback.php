<?php

namespace App\Telegram\Callbacks\Registration;

use App\Telegram\Callbacks\Callback;

class RegisterCallback extends Callback
{
    protected $name = 'registration';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь будет доступно добавление фио ребенка, возраста, района, после чего в ответ будет отправлена ссылка на родительский чат'
        ]);
    }
}
