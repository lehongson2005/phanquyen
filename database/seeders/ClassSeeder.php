<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Running ClassSeeder...');
        $itFaculty = Faculty::where('faculty_code', 'IT')->first();

        if ($itFaculty) {
            $class = ClassModel::firstOrCreate(
                ['class_code' => 'KTPM01'],
                [
                    'class_name' => 'Kỹ thuật phần mềm 01',
                    'class_faculty_id' => $itFaculty->faculty_id,
                    'class_major' => 'Kỹ thuật phần mềm',
                    'class_course_year' => '2022',
                ]
            );

            if ($class->wasRecentlyCreated) {
                $this->command->info('==> Created Class: Kỹ thuật phần mềm 01.');
            } else {
                $this->command->warn("==> Class 'KTPM01' already exists."); // Đã sửa lỗi cú pháp ở đây
            }
        } else {
            $this->command->error('==> Faculty with code IT not found in ClassSeeder. Cannot create class.');
        }
    }
}
