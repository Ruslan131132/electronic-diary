<?php

namespace Database\Seeders;

use App\Models\ClassInfo;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public const DEMO_PASSWORD = 'password';

    public const ADMIN_ID = 1000000001;
    public const TEACHER_IDS = [1000000002, 1000000003, 1000000004];
    public const PUPIL_IDS = [
        1000000011,
        1000000012,
        1000000013,
        1000000014,
        1000000015,
        1000000016,
    ];

    /**
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate(
            ['user_id' => self::ADMIN_ID],
            [
                'name' => 'Админ',
                'surname' => 'Системный',
                'patronymic' => 'Демо',
                'img' => '/img/avatar/teacher-male.png',
                'user_type' => 'Администратор',
                'password' => self::DEMO_PASSWORD,
            ]
        );

        $teachers = [
            [
                'id' => self::TEACHER_IDS[0],
                'name' => 'Иван',
                'surname' => 'Петров',
                'patronymic' => 'Сергеевич',
                'img' => '/img/avatar/teacher-male.png',
                'has_class' => '9А',
            ],
            [
                'id' => self::TEACHER_IDS[1],
                'name' => 'Анна',
                'surname' => 'Смирнова',
                'patronymic' => 'Игоревна',
                'img' => '/img/avatar/teacher-female.png',
                'has_class' => '10Б',
            ],
            [
                'id' => self::TEACHER_IDS[2],
                'name' => 'Олег',
                'surname' => 'Кузнецов',
                'patronymic' => 'Владимирович',
                'img' => '/img/avatar/teacher-male.png',
                'has_class' => null,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::query()->updateOrCreate(
                ['id' => $teacher['id']],
                [
                    'name' => $teacher['name'],
                    'surname' => $teacher['surname'],
                    'patronymic' => $teacher['patronymic'],
                    'has_class' => $teacher['has_class'],
                ]
            );

            User::query()->updateOrCreate(
                ['user_id' => $teacher['id']],
                [
                    'name' => $teacher['name'],
                    'surname' => $teacher['surname'],
                    'patronymic' => $teacher['patronymic'],
                    'img' => $teacher['img'],
                    'user_type' => 'Учитель',
                    'password' => self::DEMO_PASSWORD,
                ]
            );
        }

        $classA = ClassInfo::query()->updateOrCreate(
            ['name' => '9А'],
            ['teacher_id' => self::TEACHER_IDS[0]]
        );

        $classB = ClassInfo::query()->updateOrCreate(
            ['name' => '10Б'],
            ['teacher_id' => self::TEACHER_IDS[1]]
        );

        $pupils = [
            [
                'id' => self::PUPIL_IDS[0],
                'name' => 'Алексей',
                'surname' => 'Иванов',
                'patronymic' => 'Дмитриевич',
                'class_id' => $classA->id,
                'img' => '/img/avatar/pupil-male.png',
                'address' => 'г. Москва, ул. Примерная, д. 1',
            ],
            [
                'id' => self::PUPIL_IDS[1],
                'name' => 'Мария',
                'surname' => 'Соколова',
                'patronymic' => 'Андреевна',
                'class_id' => $classA->id,
                'img' => '/img/avatar/pupil-female.png',
                'address' => 'г. Москва, ул. Примерная, д. 2',
            ],
            [
                'id' => self::PUPIL_IDS[2],
                'name' => 'Никита',
                'surname' => 'Орлов',
                'patronymic' => 'Павлович',
                'class_id' => $classA->id,
                'img' => '/img/avatar/pupil-male.png',
                'address' => 'г. Москва, ул. Примерная, д. 3',
            ],
            [
                'id' => self::PUPIL_IDS[3],
                'name' => 'Елена',
                'surname' => 'Морозова',
                'patronymic' => 'Викторовна',
                'class_id' => $classB->id,
                'img' => '/img/avatar/pupil-female.png',
                'address' => 'г. Москва, ул. Учебная, д. 10',
            ],
            [
                'id' => self::PUPIL_IDS[4],
                'name' => 'Даниил',
                'surname' => 'Волков',
                'patronymic' => 'Олегович',
                'class_id' => $classB->id,
                'img' => '/img/avatar/pupil-male.png',
                'address' => 'г. Москва, ул. Учебная, д. 11',
            ],
            [
                'id' => self::PUPIL_IDS[5],
                'name' => 'Полина',
                'surname' => 'Лебедева',
                'patronymic' => 'Максимовна',
                'class_id' => $classB->id,
                'img' => '/img/avatar/pupil-female.png',
                'address' => 'г. Москва, ул. Учебная, д. 12',
            ],
        ];

        foreach ($pupils as $pupil) {
            Pupil::query()->updateOrCreate(
                ['id' => $pupil['id']],
                [
                    'name' => $pupil['name'],
                    'surname' => $pupil['surname'],
                    'patronymic' => $pupil['patronymic'],
                    'class_id' => $pupil['class_id'],
                    'address' => $pupil['address'],
                ]
            );

            User::query()->updateOrCreate(
                ['user_id' => $pupil['id']],
                [
                    'name' => $pupil['name'],
                    'surname' => $pupil['surname'],
                    'patronymic' => $pupil['patronymic'],
                    'img' => $pupil['img'],
                    'address' => $pupil['address'],
                    'user_type' => 'Ученик',
                    'password' => self::DEMO_PASSWORD,
                ]
            );
        }
    }
}
