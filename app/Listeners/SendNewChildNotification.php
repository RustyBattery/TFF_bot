<?php

namespace App\Listeners;

use App\Events\ChildRegistered;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Api;

class SendNewChildNotification
{
    protected Api $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle(ChildRegistered $event): void
    {
        $child = $event->child;
        $user = $child->users()->first();

        $text = "<b>Зарегестрирован ребенок</b>\n\n";
        $text .= "ФИО: " . $child->name . "\n";
        $age = Carbon::parse($child->birthdate)->age;
        $text .= "Возраст: " . $age . "\n";
        $text .= "Район: " . $child->area->name . "\n";
        $text .= "Контакт родителя: @" . $user->username . "\n";

        $this->telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHANEL_ID', ''),
            'text' => $text,
            'parse_mode' => 'HTML',
        ]);
    }
}
