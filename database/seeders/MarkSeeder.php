<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $subjectIds = Subject::query()->pluck('id');

        if ($subjectIds->isEmpty()) {
            return;
        }

        $marksByPupil = [
            UserSeeder::PUPIL_IDS[0] => [5, 4, 5, 4, 5],
            UserSeeder::PUPIL_IDS[1] => [4, 5, 4, 5, 4],
            UserSeeder::PUPIL_IDS[2] => [3, 4, 4, 3, 5],
            UserSeeder::PUPIL_IDS[3] => [5, 5, 4, 5, 5],
            UserSeeder::PUPIL_IDS[4] => [4, 3, 4, 4, 3],
            UserSeeder::PUPIL_IDS[5] => [5, 4, 5, 5, 4],
        ];

        foreach ($marksByPupil as $pupilId => $values) {
            foreach ($values as $index => $value) {
                $subjectId = $subjectIds[$index % $subjectIds->count()];

                Mark::query()->firstOrCreate(
                    [
                        'pupil_id' => $pupilId,
                        'subject_id' => $subjectId,
                        'mark' => $value,
                    ]
                );
            }
        }
    }
}
