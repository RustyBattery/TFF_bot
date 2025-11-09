<?php

namespace App\Telegram\Commands;

use App\Models\Area;
use App\Models\Lesson;
use App\Telegram\Services\UserService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class ScheduleCommand extends Command
{
    protected string $name = 'schedule';
    protected string $description = 'Расписание';
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle()
    {
        $user = $this->userService->findUserByUpdate($this->getUpdate());
        $this->userService->resetState($user);

        $areas = Area::all();

        $text = '';
        foreach ($areas as $area) {
            $text .= "<b>" . $area->name . "</b>\n<i>" . $area->address . "</i>\n";
            foreach (Lesson::DAY_ORDER as $day) {
                $lessons = $area->lessons()
                    ->where('day', $day)
                    ->orderBy('start_time')->get();
                if (count($lessons) > 0) {
                    $text .= "<b>" . Lesson::getDayName($day) . "</b>\n";
                }
                foreach ($lessons as $lesson) {
                    $text .= $lesson->getTimeRangeAttribute() . " " . $lesson->comment . "\n";
                }
            }
            $text .= "\n\n\n";
        }

        $text .= "<b>НОВИЧКИ ходят 3 раза в неделю!\n" .
            "Далее прибавляем!\n" .
            "Пробное в любой день! По расписанию!\n\n" .
            "С собой: сменные кроссовки для зала, белые носки, спортивная форма, бутылочка с водой</b>";

        $this->replyWithMessage([
            'text' => $text,
            'parse_mode' => 'HTML'
        ]);
    }
}
