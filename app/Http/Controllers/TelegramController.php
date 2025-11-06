<?php

namespace App\Http\Controllers;

use App\Telegram\CallbackManager;
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

    public function handle(Request $request, CallbackManager $callbacks)
    {
        $update = $this->telegram->commandsHandler(true);

        if ($callback = $update->getCallbackQuery()) {
            if ($handler = $callbacks->resolve($callback->getData())) {
                $handler->setContext($update, $callback)->handle();
                $this->telegram->answerCallbackQuery([
                    'callback_query_id' => $callback->getId(),
                ]);
                Log::info('callback info', [
                    'update' => $update,
                    'callback' => $callback,
                ]);
                return;
            }
        }

        Log::info('webhook info', [
            'update' => $update,
        ]);

    }
}
