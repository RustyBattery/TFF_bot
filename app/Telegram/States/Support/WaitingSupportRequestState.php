<?php

namespace App\Telegram\States\Support;

use App\Models\Child;
use App\Telegram\States\State;
use Telegram\Bot\Keyboard\Keyboard;

class WaitingSupportRequestState extends State
{
    protected $name = 'waiting_support_request';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->resetState($user);

        $requestText = $this->update->getMessage()->text;
        $user->supportRequests()->create(['request' => $requestText]);

        // оповещение админов

        $this->replyWithMessage([
            'text' => "Ваше обращение отправлено в поддержку.\n\nТекст обращения:\n" . $requestText,
            'parse_mode' => 'HTML',
        ]);
    }
}
