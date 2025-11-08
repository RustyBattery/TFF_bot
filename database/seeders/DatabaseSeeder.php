<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Area::create([
            'name' => 'Жигулевск',
            'address' => 'ДМО, Гидростроителей 10а',
        ])->lessons()->createMany([
            ['day' => 'We', 'start_time' => '16:30', 'end_time' => '18:00'],
            ['day' => 'Th', 'start_time' => '16:00', 'end_time' => '17:30'],
            ['day' => 'Sa', 'start_time' => '15:30', 'end_time' => '17:00'],
            ['day' => 'Su', 'start_time' => '13:00', 'end_time' => '14:00'],
        ]);

        Area::create([
            'name' => 'Тольятти, Автозаводский район',
            'address' => 'Школа 69, 13 квартал, 40 лет Победы, 120, музыкальный зал',
        ])->lessons()->createMany([
            ['day' => 'Mo', 'start_time' => '15:30', 'end_time' => '17:00'],
            ['day' => 'Tu', 'start_time' => '16:00', 'end_time' => '18:00'],
            ['day' => 'We', 'start_time' => '15:30', 'end_time' => '17:00'],
            ['day' => 'Th', 'start_time' => '16:00', 'end_time' => '18:00'],
            ['day' => 'Fr', 'start_time' => '15:30', 'end_time' => '17:00'],
        ]);

        Area::create([
            'name' => 'Тольятти, Центральный район',
            'address' => 'Ленина 58, школа 91, корпус Б, малый зал',
        ])->lessons()->createMany([
            ['day' => 'Tu', 'start_time' => '17:00', 'end_time' => '18:00'],
            ['day' => 'Th', 'start_time' => '17:00', 'end_time' => '18:00'],
            ['day' => 'Sa', 'start_time' => '17:00', 'end_time' => '18:00'],
        ]);

        Area::create([
            'name' => 'Тольятти, Комсомольский район',
            'address' => 'Мурысева 52а, вход со двора',
        ])->lessons()->createMany([
            ['day' => 'Mo', 'start_time' => '9:00'],
            ['day' => 'Mo', 'start_time' => '15:00'],
            ['day' => 'Mo', 'start_time' => '17:00'],
            ['day' => 'Tu', 'start_time' => '15:00'],
            ['day' => 'We', 'start_time' => '9:00'],
            ['day' => 'We', 'start_time' => '16:00', 'end_time' => '18:00'],
            ['day' => 'Th', 'start_time' => '15:00'],
            ['day' => 'Th', 'start_time' => '17:00'],
            ['day' => 'Fr', 'start_time' => '9:00'],
            ['day' => 'Fr', 'start_time' => '15:00'],
            ['day' => 'Fr', 'start_time' => '17:00'],
            ['day' => 'Sa', 'start_time' => '14:00'],
        ]);

        Area::create([
            'name' => 'Тольятти, Автозаводский район',
            'address' => 'ДС Волгарь вход со стороны Веги, зал Фехтования',
        ])->lessons()->createMany([
            ['day' => 'Mo', 'start_time' => '16:00'],
            ['day' => 'Mo', 'start_time' => '19:00'],
            ['day' => 'Tu', 'start_time' => '15:30'],
            ['day' => 'Tu', 'start_time' => '17:00', 'end_time' => '18:30'],
            ['day' => 'We', 'start_time' => '16:00'],
            ['day' => 'We', 'start_time' => '19:00'],
            ['day' => 'Th', 'start_time' => '15:30'],
            ['day' => 'Th', 'start_time' => '17:00', 'end_time' => '18:30'],
            ['day' => 'Fr', 'start_time' => '15:30'],
            ['day' => 'Fr', 'start_time' => '16:00'],
            ['day' => 'Fr', 'start_time' => '19:00'],
            ['day' => 'Sa', 'start_time' => '16:00', 'end_time' => '17:00'],
            ['day' => 'Sa', 'start_time' => '17:00', 'end_time' => '18:00'],
        ]);
    }
}
