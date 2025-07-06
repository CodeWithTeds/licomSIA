<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Computer Science',
            'Information Technology',
            'Computer Engineering',
            'Software Engineering',
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
        ];

        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
