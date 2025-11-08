<?php

namespace App\Listeners;

use App\Events\SupportRequestCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Api;

class SendNewSupportRequestNotification
{
    protected Api $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle(SupportRequestCreated $event): void
    {
        $supportRequest = $event->supportRequest;
        $user = $supportRequest->user;

        $text = "<b>Обращение в поддержку</b>\n\n";
        $text .= "Пользователь: @" . $user->username . "\n";
        $text .= "Сообщение: " . $supportRequest->request . "\n";

        $this->telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHANEL_ID', ''),
            'text' => $text,
            'parse_mode' => 'HTML',
        ]);
    }
}
