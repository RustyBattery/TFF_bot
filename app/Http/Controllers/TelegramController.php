<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        Log::debug('raw webhook', [$request->all(), $request->getContent()]);
        $updates = Telegram::getWebhookUpdate();
        Log::debug('debug webhook', [$updates]);
    }
}
