<?php

namespace App\Providers;

use App\Telegram\CallbackManager;
use App\Telegram\Callbacks\Registration\RegisterCallback;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $callbackManager = app(CallbackManager::class);
        $callbackManager->register(RegisterCallback::class);
    }
}
