<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use Illuminate\Database\Seeder;

class CabinetSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $cabinets = [
            ['name' => '101', 'type' => 'Обычный'],
            ['name' => '203', 'type' => 'Обычный'],
            ['name' => '305', 'type' => 'Компьютерный'],
            ['name' => '412', 'type' => 'Лаборатория'],
            ['name' => 'Спортзал', 'type' => 'Спортивный'],
        ];

        foreach ($cabinets as $cabinet) {
            Cabinet::query()->firstOrCreate(
                ['name' => $cabinet['name']],
                ['type' => $cabinet['type']]
            );
        }
    }
}
