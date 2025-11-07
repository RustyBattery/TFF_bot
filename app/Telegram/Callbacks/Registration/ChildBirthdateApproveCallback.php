<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Area;
use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;
use Telegram\Bot\Keyboard\Keyboard;

class ChildBirthdateApproveCallback extends Callback
{
    protected $name = 'child_birthdate_approve';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_child_area');

        $reply_markup = Keyboard::make()->inline();

        foreach (Area::all() as $area) {
            $reply_markup->row([
                Keyboard::inlineButton([
                    'text' => $area->name . ' (' . $area->address . ')',
                    'callback_data' => 'select_area_' . $area->id,
                ])
            ]);
        }


        $this->replyWithMessage([
            'text' => "Выберете район в котором планируете посещать занятия",
            'parse_mode' => 'MarkdownV2',
            'reply_markup' => $reply_markup,
        ]);
    }
}
