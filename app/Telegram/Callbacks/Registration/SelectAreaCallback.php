<?php

namespace App\Telegram\Callbacks\Registration;

use App\Models\Area;
use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;
use Telegram\Bot\Keyboard\Keyboard;

class SelectAreaCallback extends Callback
{
    protected $pattern = 'select_area_(\d+)';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
        $this->userService->setState($user, 'approval_child_area');

        preg_match("/^select_area_(\d+)$/", $this->callback->getData(), $match);
        $areaId = (int)$match[1];
        $area = Area::find($areaId);

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Да', 'callback_data' => 'child_area_approve']),
                Keyboard::inlineButton(['text' => 'Нет', 'callback_data' => 'child_area_reset'])
            ]);

        $this->replyWithMessage([
            'text' => "Район: <b>".$area->name. "</b>\n" . $area->address . "\n\nПодтвердить?",
            'parse_mode' => 'HTML',
            'reply_markup' => $reply_markup
        ]);
    }
}
