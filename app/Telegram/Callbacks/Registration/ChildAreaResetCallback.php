<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Area;
use App\Telegram\Callbacks\Callback;
use Telegram\Bot\Keyboard\Keyboard;

class ChildAreaResetCallback extends Callback
{
    protected $name = 'child_area_reset';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'waiting_child_area');
        $child = $user->children()->first();
        $child->area_id = null;
        $child->save();

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
