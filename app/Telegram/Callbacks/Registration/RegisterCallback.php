<?php

namespace App\Telegram\Callbacks\Registration;

use App\Telegram\Callbacks\Callback;

class RegisterCallback extends Callback
{
    protected $name = 'registration';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Registration callback'
        ]);
    }
}
