<?php

namespace App\Telegram\Callbacks\Support;

use App\Telegram\Callbacks\Callback;

class SupportCallback extends Callback
{
    protected $name = 'support';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Позже здесь будет доступно обращение в поддержку'
        ]);
    }
}
