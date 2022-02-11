<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Pupil;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Робототехника',
                'description' => 'Практический кружок по сборке и программированию роботов.',
                'img' => '/img/courses/c1.jpg',
                'price' => 0,
                'training_period' => '3 месяца',
                'teacher_id' => UserSeeder::TEACHER_IDS[2],
            ],
            [
                'name' => 'Олимпиадная математика',
                'description' => 'Подготовка к школьным и городским олимпиадам.',
                'img' => '/img/courses/c2.jpg',
                'price' => 1500,
                'training_period' => '6 месяцев',
                'teacher_id' => UserSeeder::TEACHER_IDS[0],
            ],
            [
                'name' => 'Английский разговорный клуб',
                'description' => 'Разговорная практика и подготовка к презентациям.',
                'img' => '/img/courses/c3.jpg',
                'price' => 1000,
                'training_period' => '4 месяца',
                'teacher_id' => UserSeeder::TEACHER_IDS[1],
            ],
        ];

        $created = [];

        foreach ($courses as $course) {
            $created[] = Course::query()->updateOrCreate(
                ['name' => $course['name']],
                $course
            );
        }

        $pupilA = Pupil::query()->find(UserSeeder::PUPIL_IDS[0]);
        $pupilB = Pupil::query()->find(UserSeeder::PUPIL_IDS[3]);

        if ($pupilA && isset($created[0], $created[1])) {
            $pupilA->course()->syncWithoutDetaching([$created[0]->id, $created[1]->id]);
        }

        if ($pupilB && isset($created[2])) {
            $pupilB->course()->syncWithoutDetaching([$created[2]->id]);
        }
    }
}
