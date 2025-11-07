<?php

namespace App\Telegram\States\Registration;

use App\Telegram\States\State;

class WaitingChildNameState extends State
{
    protected $name = 'waiting_child_name';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->resetState($user);

        $this->replyWithMessage([
            'text' => 'ФИО:' . $this->update->getMessage()->text,
        ]);
    }
}
