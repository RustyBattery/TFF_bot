<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class RegisterCallback extends Callback
{
    protected $name = 'registration';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);

        if (!$user->accepted_pd) {
            $reply_markup = Keyboard::make()
                ->inline()
                ->row([
                    Keyboard::inlineButton(['text' => 'Согласен', 'callback_data' => 'accept_pd']),
                ]);
            $this->telegram->sendDocument([
                'chat_id' => $this->chatId,
                'document' => InputFile::create(storage_path('app/public/consent.docx')),
                'caption' => "Для продолжения необходимо согласие на обработку персональных данных.\n\n" .
                    "Нажимая «Согласен», вы подтверждаете, что ознакомились с документом и подтверждаете согласие.",
                'reply_markup' => $reply_markup,
            ]);
            return;
        }

        $this->userService->setState($user, 'waiting_child_name');

        $this->replyWithMessage([
            'text' => 'Введите ФИО ребенка'
        ]);
    }
}
