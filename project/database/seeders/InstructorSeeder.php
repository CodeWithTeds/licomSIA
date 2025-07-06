<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Instructor;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all departments and positions
        $departments = Department::all();
        $positions = Position::all();

        $instructors = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'department_id' => $departments->where('name', 'Computer Science')->first()->id ?? 1,
                'position_id' => $positions->where('name', 'Professor')->first()->id ?? 1,
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Garcia',
                'department_id' => $departments->where('name', 'Mathematics')->first()->id ?? 2,
                'position_id' => $positions->where('name', 'Associate Professor')->first()->id ?? 2,
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Johnson',
                'department_id' => $departments->where('name', 'Information Technology')->first()->id ?? 3,
                'position_id' => $positions->where('name', 'Assistant Professor')->first()->id ?? 3,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Wong',
                'department_id' => $departments->where('name', 'Computer Engineering')->first()->id ?? 4,
                'position_id' => $positions->where('name', 'Lecturer')->first()->id ?? 4,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Rodriguez',
                'department_id' => $departments->where('name', 'Software Engineering')->first()->id ?? 5,
                'position_id' => $positions->where('name', 'Adjunct Professor')->first()->id ?? 5,
            ],
        ];

        foreach ($instructors as $instructorData) {
            Instructor::create($instructorData);
        }
    }
}
