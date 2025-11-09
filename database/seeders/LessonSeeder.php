<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Жигулевск
        $area = Area::where('name', 'Жигулевск')
            ->where('address', 'ДМО, Гидростроителей 10а')->first();
        $area->lessons()->delete();
        $area->lessons()->createMany([
            // Среда
            ['day' => 'We', 'start_time' => '16:30', 'end_time' => '18:00'],
            // Четверг
            ['day' => 'Th', 'start_time' => '16:00', 'end_time' => '17:30'],
            // Суббота
            ['day' => 'Sa', 'start_time' => '15:30', 'end_time' => '17:00'],
            // Воскресенье
            ['day' => 'Su', 'start_time' => '13:00', 'end_time' => '14:00'],
        ]);

        // Автозаводский Школа 69
        $area = Area::where('name', 'Тольятти, Автозаводский район')
            ->where('address', 'Школа 69, 13 квартал, 40 лет Победы, 120, музыкальный зал')->first();
        $area->lessons()->delete();
        $area->lessons()->createMany([
            // Понедельник
            ['day' => 'Mo', 'start_time' => '15:30', 'end_time' => '16:30'],
            // Вторник
            ['day' => 'Tu', 'start_time' => '16:00', 'end_time' => '18:00'],
            // Среда
            ['day' => 'We', 'start_time' => '15:30', 'end_time' => '16:30'],
            // Четверг
            ['day' => 'Th', 'start_time' => '16:00', 'end_time' => '18:00'],
            // Пятница
            ['day' => 'Fr', 'start_time' => '16:00', 'end_time' => '18:00'],
            // Суббота
            // Боевая в волгаре (для тех кто фехтует) время уточнить
            // Воскресенье
            ['day' => 'Su', 'start_time' => '12:00', 'end_time' => '14:00'],
        ]);

        // Центральный район
        $area = Area::where('name', 'Тольятти, Центральный район')
            ->where('address', 'Ленина 58, школа 91, корпус Б, малый зал')->first();
        $area->lessons()->delete();
        $area->lessons()->createMany([
            // Вторник
            ['day' => 'Tu', 'start_time' => '17:00', 'end_time' => '18:00'],
            // Четверг
            ['day' => 'Th', 'start_time' => '17:00', 'end_time' => '18:00'],
            // Суббота
            ['day' => 'Sa', 'start_time' => '17:00', 'end_time' => '18:00'],
        ]);

        // Комсомольский район
        $area = Area::where('name', 'Тольятти, Комсомольский район')
            ->where('address', 'Мурысева 52а, вход со двора')->first();
        $area->lessons()->delete();
        $area->lessons()->createMany([
            // Понедельник
            ['day' => 'Mo', 'start_time' => '15:00', 'comment' => 'ср и старшая группа и новички'],
            ['day' => 'Mo', 'start_time' => '17:00', 'comment' => 'мл группа и новички'],
            // Вторник
            ['day' => 'Tu', 'start_time' => '9:00', 'comment' => 'группа 2 смена новички'],
            ['day' => 'Tu', 'start_time' => '15:00', 'comment' => 'мл группа и новички'],
            ['day' => 'Tu', 'start_time' => '16:00', 'comment' => 'ср и старшая группа'],
            // Среда
            ['day' => 'We', 'start_time' => '16:00', 'end_time' => '18:00', 'comment' => 'ОФП всем кто не в волгаре'],
            ['day' => 'We', 'start_time' => '17:00', 'comment' => 'старшие боевая Волгарь или Комса!(уточнить у тренера)'],
            // Четверг
            ['day' => 'Th', 'start_time' => '9:00', 'comment' => 'группа 2 смена'],
            ['day' => 'Th', 'start_time' => '15:00', 'comment' => 'средняя группа и младшая группа'],
            ['day' => 'Th', 'start_time' => '16:00', 'comment' => 'ст группа'],
            ['day' => 'Th', 'start_time' => '17:00', 'comment' => 'младшая группа и новички'],
            // Пятница
            ['day' => 'Fr', 'start_time' => '15:00', 'comment' => 'ср и старшая группа'],
            ['day' => 'Fr', 'start_time' => '17:00', 'comment' => 'мл группа'],
            // Суббота
            ['day' => 'Sa', 'start_time' => '13:00', 'comment' => 'боевая практика Волгарь для средних'],
            ['day' => 'Sa', 'start_time' => '14:00', 'comment' => 'боевая практика в Волгаре для старших'],
            ['day' => 'Sa', 'start_time' => '14:00', 'comment' => 'ОФП всем младшим и новичкам'],
            ['day' => 'Sa', 'start_time' => '15:00', 'comment' => 'родители и взрослые'],
        ]);

        // Автозаводский район Волдарь
        $area = Area::where('name', 'Тольятти, Автозаводский район')
            ->where('address', 'ДС Волгарь вход со стороны Веги, зал Фехтования')->first();
        $area->lessons()->delete();
        $area->lessons()->createMany([
            // Понедельник
            ['day' => 'Mo', 'start_time' => '16:00', 'comment' => 'средние и новички ОФП'],
            ['day' => 'Mo', 'start_time' => '17:15', 'end_time' => '19:00', 'comment' => 'ОФП старшие'],
            ['day' => 'Mo', 'start_time' => '18:30', 'end_time' => '20:00', 'comment' => 'малыши и новички ОФП'],
            // Вторник
            ['day' => 'Tu', 'start_time' => '15:00', 'end_time' => '16:30', 'comment' => 'средние и новички фехтование'],
            ['day' => 'Tu', 'start_time' => '16:00', 'end_time' => '19:00', 'comment' => 'старшие фехтование'],
            ['day' => 'Tu', 'start_time' => '16:30', 'end_time' => '18:30', 'comment' => 'новички новый зал'],
            // Среда
            ['day' => 'We', 'start_time' => '17:15', 'comment' => 'новички все (новый зал)'],
            ['day' => 'We', 'start_time' => '17:30', 'comment' => 'старшие СФП'],
            ['day' => 'We', 'start_time' => '19:00', 'comment' => 'взрослые и новички фехтование и ОФП'],
            // Четверг
            ['day' => 'Th', 'start_time' => '15:00', 'end_time' => '16:30', 'comment' => 'средние и новички фехтование'],
            ['day' => 'Th', 'start_time' => '16:00', 'end_time' => '19:00', 'comment' => 'старшие фехтование'],
            ['day' => 'Th', 'start_time' => '16:30', 'end_time' => '18:30', 'comment' => 'новички новый зал'],
            // Пятница
            ['day' => 'Fr', 'start_time' => '15:30', 'comment' => 'средние и новички фехтование'],
            ['day' => 'Fr', 'start_time' => '17:00', 'comment' => 'старшие фехтование'],
            ['day' => 'Fr', 'start_time' => '18:30', 'comment' => 'взрослые и новички  фехтование'],
            // Суббота
            ['day' => 'Sa', 'start_time' => '12:00', 'comment' => 'уроки по графику'],
            ['day' => 'Sa', 'start_time' => '13:00', 'comment' => 'средние и младшие боевая'],
            ['day' => 'Sa', 'start_time' => '14:00', 'comment' => 'старшие боевая'],
            ['day' => 'Sa', 'start_time' => '16:30', 'end_time' => '18:00', 'comment' => 'новички все новый зал'],
        ]);
    }
}
