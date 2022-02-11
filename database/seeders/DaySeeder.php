<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $days = [
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота',
        ];

        foreach ($days as $number => $name) {
            Day::query()->updateOrCreate(
                ['number' => $number],
                ['name' => $name]
            );
        }
    }
}
