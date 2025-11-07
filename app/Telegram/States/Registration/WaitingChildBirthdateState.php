<?php

namespace App\Telegram\States\Registration;

use App\Models\Child;
use App\Telegram\States\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Keyboard\Keyboard;

class WaitingChildBirthdateState extends State
{
    protected $name = 'waiting_child_birthdate';

    public function handle()
    {
        $birthdate = $this->update->getMessage()->text;

        $validator = Validator::make(
            ['birthdate' => $birthdate],
            ['birthdate' => 'required|date_format:d.m.Y']
        );

        if ($validator->fails()) {
            $this->replyWithMessage([
                'text' => "Неверный формат даты\\. Пожалуйста, введите в формате *дд\\.мм\\.гггг*",
                'parse_mode' => 'MarkdownV2',
            ]);
            return;
        }

        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'approval_child_birthdate');

        $birthdate = Carbon::createFromFormat('d.m.Y', $birthdate);
        if ($child = $user->children()->first()) {
            $child->birthdate = $birthdate;
            $child->save();
        } else {
            $user->children()->create(['birthdate' => $birthdate]);
        }

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Да', 'callback_data' => 'child_birthdate_approve']),
                Keyboard::inlineButton(['text' => 'Нет', 'callback_data' => 'child_birthdate_reset'])
            ]);

        $this->replyWithMessage([
            'text' => "Дата рождения: *$birthdate*\n\nПодтвердить?",
            'parse_mode' => 'MarkdownV2',
            'reply_markup' => $reply_markup
        ]);
    }
}
