<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        $telegram = new Api(config('telegram.bots.mybot.token'));
        $update = $telegram->getWebhookUpdate();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }
}
