<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Running UserSeeder...');

        $faculty = Faculty::first() ?? Faculty::factory()->create();
        $class = ClassModel::first() ?? ClassModel::factory()->create(['class_faculty_id' => $faculty->faculty_id]);

        User::firstOrCreate(
            ['user_email' => 'admin@gmail.com'],
            [
                'user_student_code' => 'ADMIN01',
                'user_full_name' => 'Adminstrator',
                'user_faculty_id' => $faculty->faculty_id,
                'user_class_id' => $class->class_id,
                'user_major' => 'System Admin',
                'user_course_year' => '2020',
                'user_username' => 'admin',
                'user_password' => Hash::make('123456'),
            ]
        );

        User::where('user_email', '!=', 'admin@gmail.com')->delete();
        $this->command->info('==> Deleted old student users.');

        $this->command->info('==> Preparing 100 new student records from your factory...');
        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $users[] = User::factory()->definition();
        }

        $this->command->info('==> Bulk inserting 100 records...');
        foreach (array_chunk($users, 50) as $chunk) {
            User::insert($chunk);
        }

        $this->command->info('UserSeeder finished successfully.');
    }
}