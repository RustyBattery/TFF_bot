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
            $text .= "<b>" . $area->name . "</b>\n" . $area->address . "\n\n";
            foreach (Lesson::DAY_ORDER as $day) {
                $lessons = $area->lessons()
                    ->where('day', $day)
                    ->orderBy('start_time')->get();
                $text .= Lesson::getDayName($day) . "\n";
                foreach ($lessons as $lesson) {
                    $text .= $lesson->getTimeRangeAttribute() . "\n";
                }
            }
            $text .= "\n\n\n";
        }

        $this->replyWithMessage([
            'text' => $text,
            'parse_mode' => 'HTML'
        ]);
    }
}
