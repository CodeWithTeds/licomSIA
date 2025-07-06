<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all departments to associate with programs
        $departments = Department::all();
        
        if ($departments->isEmpty()) {
            $this->command->info('No departments found. Please run the DepartmentSeeder first.');
            return;
        }

        $programs = [
            [
                'program_name' => 'Bachelor of Science in Computer Science',
                'department_id' => $departments->where('name', 'Computer Science')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Bachelor of Science in Information Technology',
                'department_id' => $departments->where('name', 'Information Technology')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Bachelor of Science in Computer Engineering',
                'department_id' => $departments->where('name', 'Computer Engineering')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Bachelor of Science in Software Engineering',
                'department_id' => $departments->where('name', 'Software Engineering')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Master of Science in Computer Science',
                'department_id' => $departments->where('name', 'Computer Science')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Master of Science in Information Technology',
                'department_id' => $departments->where('name', 'Information Technology')->first()->id ?? $departments->first()->id,
            ],
            [
                'program_name' => 'Doctor of Philosophy in Computer Science',
                'department_id' => $departments->where('name', 'Computer Science')->first()->id ?? $departments->first()->id,
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(
                ['program_name' => $program['program_name']],
                $program
            );
        }
    }
} 