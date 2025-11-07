<?php

namespace App\Telegram\Commands;

use App\Telegram\Services\UserService;
use Carbon\Carbon;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class InfoCommand extends Command
{
    protected string $name = 'info';
    protected string $description = 'Моя информация';
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle()
    {
        $user = $this->userService->findUserByUpdate($this->getUpdate());
        $this->userService->resetState($user);

        $child = $user->children()->first();

        if (!$child) {
            $reply_markup = Keyboard::make()
                ->inline()
                ->row([
                    Keyboard::inlineButton(['text' => 'Внести информацию о ребенке', 'callback_data' => 'registration'])
                ]);
            $this->replyWithMessage([
                'text' => 'Данные о ребенке еще не внесены, вы можете сделать это, нажав кнопку ниже',
                'reply_markup' => $reply_markup,
            ]);
            return;
        }

        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton(['text' => 'Изменить информацию о ребенке', 'callback_data' => 'registration'])
            ]);

        $firstString = "<b>Информация о ребенке:</b>\n";
        $nameString = "ФИО: ". ($child->name ?? '-') . "\n";
        $birthdateString = "Дата рождения: ". ($child->birthdate ?? '-') . "\n";
        $area = $child->area ;
        $areaString = "Район: ". ($area ? $area->name : '-') . " (". ($area ? $area->address : '') . ")";

        $this->replyWithMessage([
            'text' => $firstString . $nameString . $birthdateString . $areaString,
            'parse_mode' => 'HTML',
            'reply_markup' => $reply_markup,
        ]);
    }
}
