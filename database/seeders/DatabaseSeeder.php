<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data for local / Docker runs.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DaySeeder::class,
            LessonSeeder::class,
            CabinetSeeder::class,
            SubjectSeeder::class,
            UserSeeder::class,
            ScheduleSeeder::class,
            MarkSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
