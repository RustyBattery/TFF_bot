<?php

namespace App\Providers;

use App\Telegram\CallbackManager;
use App\Telegram\Callbacks\Registration\ChildNameApproveCallback;
use App\Telegram\Callbacks\Registration\ChildNameResetCallback;
use App\Telegram\Callbacks\Registration\RegisterCallback;
use App\Telegram\Callbacks\Schedule\ScheduleCallback;
use App\Telegram\Callbacks\Support\SupportCallback;
use App\Telegram\Commands\InfoCommand;
use App\Telegram\Commands\ScheduleCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\SupportCommand;
use App\Telegram\StateManager;
use App\Telegram\States\Registration\WaitingChildBirthdateState;
use App\Telegram\States\Registration\WaitingChildNameState;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CallbackManager::class);
        $this->app->singleton(StateManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Telegram::addCommand(StartCommand::class);
        Telegram::addCommand(InfoCommand::class);
        Telegram::addCommand(ScheduleCommand::class);
        Telegram::addCommand(SupportCommand::class);

        $callbackManager = app(CallbackManager::class);
        $callbackManager->register(RegisterCallback::class);
        $callbackManager->register(ScheduleCallback::class);
        $callbackManager->register(SupportCallback::class);
        $callbackManager->register(ChildNameApproveCallback::class);
        $callbackManager->register(ChildNameResetCallback::class);

        $stateManager = app(StateManager::class);
        $stateManager->register(WaitingChildNameState::class);
        $stateManager->register(WaitingChildBirthdateState::class);
    }
}
