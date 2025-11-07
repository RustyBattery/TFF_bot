<?php

namespace App\Http\Controllers;

use App\Telegram\CallbackManager;
use App\Telegram\Services\UserService;
use App\Telegram\StateManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    protected Api $telegram;
    protected UserService $userService;

    public function __construct(Api $telegram, UserService $userService)
    {
        $this->telegram = $telegram;
        $this->userService = $userService;
    }

    public function handle(CallbackManager $callbacks, StateManager $states)
    {
        $update = $this->telegram->getWebhookUpdate();
        $user = $this->userService->createOrUpdateUser($update);

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

        if ($handler = $states->resolve($user->state->state)) {
            $handler->setContext($update)->handle();
            Log::info('state info', [
                'update' => $update,
            ]);
            return;
        }

        Log::info('webhook info', [
            'update' => $update,
        ]);
    }
}
