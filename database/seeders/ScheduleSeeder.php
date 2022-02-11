<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use App\Models\ClassInfo;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $classA = ClassInfo::query()->where('name', '9А')->first();
        $classB = ClassInfo::query()->where('name', '10Б')->first();

        if (!$classA || !$classB) {
            return;
        }

        $subjects = Subject::query()->pluck('id', 'name');
        $cabinets = Cabinet::query()->pluck('id', 'name');

        $slots = [
            // class 9A
            [$classA->id, 'Математика', 1, 1, '101', UserSeeder::TEACHER_IDS[0]],
            [$classA->id, 'Русский язык', 1, 2, '203', UserSeeder::TEACHER_IDS[1]],
            [$classA->id, 'Информатика', 1, 3, '305', UserSeeder::TEACHER_IDS[2]],
            [$classA->id, 'Физика', 2, 1, '412', UserSeeder::TEACHER_IDS[2]],
            [$classA->id, 'История', 2, 2, '203', UserSeeder::TEACHER_IDS[1]],
            [$classA->id, 'Физкультура', 3, 1, 'Спортзал', UserSeeder::TEACHER_IDS[0]],
            // class 10B
            [$classB->id, 'Математика', 1, 1, '101', UserSeeder::TEACHER_IDS[0]],
            [$classB->id, 'Английский язык', 1, 2, '203', UserSeeder::TEACHER_IDS[1]],
            [$classB->id, 'Литература', 2, 1, '203', UserSeeder::TEACHER_IDS[1]],
            [$classB->id, 'Информатика', 2, 2, '305', UserSeeder::TEACHER_IDS[2]],
            [$classB->id, 'Физика', 3, 2, '412', UserSeeder::TEACHER_IDS[2]],
            [$classB->id, 'История', 4, 1, '203', UserSeeder::TEACHER_IDS[1]],
        ];

        foreach ($slots as $slot) {
            [$classId, $subjectName, $day, $lesson, $cabinetName, $teacherId] = $slot;

            if (!isset($subjects[$subjectName], $cabinets[$cabinetName])) {
                continue;
            }

            $schedule = Schedule::query()->updateOrCreate(
                [
                    'class_id' => $classId,
                    'day_number' => $day,
                    'lesson_number' => $lesson,
                ],
                [
                    'subject_id' => $subjects[$subjectName],
                    'cabinet_id' => $cabinets[$cabinetName],
                ]
            );

            DB::table('schedules_teachers')->updateOrInsert(
                [
                    'schedule_id' => $schedule->id,
                    'teacher_id' => $teacherId,
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
