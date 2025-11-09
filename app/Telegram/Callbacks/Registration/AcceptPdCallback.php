<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;
use Carbon\Carbon;
use Telegram\Bot\Keyboard\Keyboard;

class AcceptPdCallback extends Callback
{
    protected $name = 'accept_pd';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->resetState($user);
        $user->accepted_pd = Carbon::now();
        $user->save();

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Внести информацию о ребенке', 'callback_data' => 'registration'])
            ]);

        $this->replyWithMessage([
            'text' => "Согласие принято! Можете продолжить регистрацию ребенка!",
            'reply_markup' => $reply_markup
        ]);
    }
}
