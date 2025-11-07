<?php

namespace App\Telegram\States\Registration;

use App\Models\Child;
use App\Telegram\States\State;
use Telegram\Bot\Keyboard\Keyboard;

class WaitingChildNameState extends State
{
    protected $name = 'waiting_child_name';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'approval_child_name');

        $childName = $this->update->getMessage()->text;

        if ($child = $user->children()->first()) {
            $child->name = $childName;
            $child->save();
        } else {
            $user->children()->create(['name' => $childName]);
        }

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Да', 'callback_data' => 'child_name_approve']),
                Keyboard::inlineButton(['text' => 'Нет', 'callback_data' => 'child_name_reset'])
            ]);

        $this->replyWithMessage([
            'text' => "ФИО ребенка: *$childName*\n\nПодтвердить?",
            'parse_mode' => 'MarkdownV2',
            'reply_markup' => $reply_markup
        ]);
    }
}
