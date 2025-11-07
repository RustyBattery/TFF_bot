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
        ]);
        Area::create([
            'name' => 'Тольятти, Автозаводский район',
            'address' => 'Школа 69, 13 квартал, 40 лет Победы, 120, музыкальный зал',
        ]);
        Area::create([
            'name' => 'Тольятти, Центральный район',
            'address' => 'Ленина 58, школа 91, корпус Б, малый зал',
        ]);
        Area::create([
            'name' => 'Тольятти, Комсомольский район',
            'address' => 'Мурысева 52а, вход со двора',
        ]);
        Area::create([
            'name' => 'Тольятти, Автозаводский район',
            'address' => 'ДС Волгарь вход со стороны Веги, зал Фехтования',
        ]);
    }
}
