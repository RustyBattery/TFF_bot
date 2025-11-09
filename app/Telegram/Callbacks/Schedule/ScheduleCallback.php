<?php

namespace App\Telegram\Callbacks\Schedule;

use App\Models\Area;
use App\Models\Lesson;
use App\Models\Telegram\UserState;
use App\Telegram\Callbacks\Callback;

class ScheduleCallback extends Callback
{
    protected $name = 'schedule';

    public function handle()
    {
        $user = $this->userService->findUserByChatId($this->chatId);
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
