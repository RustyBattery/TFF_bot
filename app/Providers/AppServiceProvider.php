<?php

namespace App\Providers;

use App\Telegram\CallbackManager;
use App\Telegram\Callbacks\Registration\AcceptPdCallback;
use App\Telegram\Callbacks\Registration\ChildAreaApproveCallback;
use App\Telegram\Callbacks\Registration\ChildAreaResetCallback;
use App\Telegram\Callbacks\Registration\ChildBirthdateApproveCallback;
use App\Telegram\Callbacks\Registration\ChildBirthdateResetCallback;
use App\Telegram\Callbacks\Registration\ChildNameApproveCallback;
use App\Telegram\Callbacks\Registration\ChildNameResetCallback;
use App\Telegram\Callbacks\Registration\RegisterCallback;
use App\Telegram\Callbacks\Registration\SelectAreaCallback;
use App\Telegram\Callbacks\Schedule\ScheduleCallback;
use App\Telegram\Callbacks\Support\SupportCallback;
use App\Telegram\Commands\InfoCommand;
use App\Telegram\Commands\ScheduleCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\SupportCommand;
use App\Telegram\StateManager;
use App\Telegram\States\Registration\WaitingChildBirthdateState;
use App\Telegram\States\Registration\WaitingChildNameState;
use App\Telegram\States\Support\WaitingSupportRequestState;
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
        $callbackManager->register(ChildBirthdateApproveCallback::class);
        $callbackManager->register(ChildBirthdateResetCallback::class);
        $callbackManager->register(SelectAreaCallback::class);
        $callbackManager->register(ChildAreaApproveCallback::class);
        $callbackManager->register(ChildAreaResetCallback::class);
        $callbackManager->register(AcceptPdCallback::class);

        $stateManager = app(StateManager::class);
        $stateManager->register(WaitingChildNameState::class);
        $stateManager->register(WaitingChildBirthdateState::class);
        $stateManager->register(WaitingSupportRequestState::class);
    }
}
