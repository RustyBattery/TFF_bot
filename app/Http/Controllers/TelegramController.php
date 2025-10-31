<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    protected Api $telegram;
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }
    public function handle(Request $request)
    {
        $update = $this->telegram->commandsHandler(true);

        $callback = $update->getCallbackQuery();

        if ($callback) {
            $data = $callback->getData();
            $chatId = $callback->getMessage()->getChat()->getId();

            $this->telegram->sendMessage(['chat_id' => $chatId, 'text' => $data]);

            $this->telegram->answerCallbackQuery([
                'callback_query_id' => $callback->getId(),
            ]);
        }

        Log::info('webhook info', [
            'update' => $update,
        ]);

    }
}
