<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Log::debug('meow meow');
    return 'TFF_bot';
});

Route::post('/webhook/telegram', [TelegramController::class, 'handle'])->withoutMiddleware(VerifyCsrfToken::class);
