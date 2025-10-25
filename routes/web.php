<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Log::debug('meow meow');
    return 'TFF_bot';
});

