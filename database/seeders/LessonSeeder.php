<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $lessons = [
            1 => ['08:30:00', '09:15:00'],
            2 => ['09:25:00', '10:10:00'],
            3 => ['10:30:00', '11:15:00'],
            4 => ['11:25:00', '12:10:00'],
            5 => ['12:20:00', '13:05:00'],
            6 => ['13:25:00', '14:10:00'],
            7 => ['14:20:00', '15:05:00'],
        ];

        foreach ($lessons as $number => $times) {
            Lesson::query()->updateOrCreate(
                ['number' => $number],
                [
                    'start_time' => $times[0],
                    'end_time' => $times[1],
                ]
            );
        }
    }
}
