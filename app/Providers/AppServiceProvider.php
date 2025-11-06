<?php

namespace App\Providers;

use App\Telegram\CallbackManager;
use App\Telegram\Callbacks\Registration\RegisterCallback;
use App\Telegram\Callbacks\Schedule\ScheduleCallback;
use App\Telegram\Callbacks\Support\SupportCallback;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CallbackManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $callbackManager = app(CallbackManager::class);
        $callbackManager->register(RegisterCallback::class);
        $callbackManager->register(ScheduleCallback::class);
        $callbackManager->register(SupportCallback::class);
    }
}
