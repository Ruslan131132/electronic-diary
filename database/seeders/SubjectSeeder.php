<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $subjects = [
            'Математика',
            'Русский язык',
            'Литература',
            'История',
            'Физика',
            'Информатика',
            'Английский язык',
            'Физкультура',
        ];

        foreach ($subjects as $name) {
            Subject::query()->firstOrCreate(['name' => $name]);
        }
    }
}
