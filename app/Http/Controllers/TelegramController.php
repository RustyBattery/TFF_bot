<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    protected Api $telegram;
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }
    public function handle(Request $request)
    {
        $update = $this->telegram->getWebhookUpdate();

        $response = $this->telegram->sendMessage([
            'chat_id' => $update->getChat()->id ?? '',
            'text' => $update->getMessage()->text ?? '',
        ]);

        Log::info('webhook info', [
            'update' => $update,
            'response' => $response,
        ]);

    }
}

//{
//  "update_id":213496714,
//  "message":{
//      "message_id":22,
//      "from":{
//          "id":1236822007,
//          "is_bot":false,
//          "first_name":"Rita",
//          "last_name":"Adukova",
//          "username":"rusty_battery",
//          "language_code":"ru"},
//          "chat":{
//              "id":1236822007,
//              "first_name":"Rita",
//              "last_name":"Adukova",
//              "username":"rusty_battery",
//              "type":"private"
//          },
//          "date":1761912796,
//          "text":"/command1",
//          "entities":[
//              {"offset":0,"length":9,"type":"bot_command"}
//          ]
//      }
//  }
