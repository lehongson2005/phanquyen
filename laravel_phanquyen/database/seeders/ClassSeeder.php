<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $itFaculty = Faculty::where('faculty_code', 'IT')->first();

        if ($itFaculty) {
            ClassModel::firstOrCreate(
                ['class_code' => 'KTPM01'],
                [
                    'class_name' => 'Kỹ thuật phần mềm 01',
                    'class_faculty_id' => $itFaculty->faculty_id,
                    'class_major' => 'Kỹ thuật phần mềm',
                    'class_course_year' => '2022',
                    'class_teacher_in_charge' => 'ThS. Lê Văn Luyện',
                ]
            );
        }
    }
}
