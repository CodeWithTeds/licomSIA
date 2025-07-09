<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Program;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all programs
        $programs = Program::all();
        
        if ($programs->isEmpty()) {
            $this->command->info('No programs found. Please run ProgramSeeder first.');
            return;
        }
        
        // Create sample students
        $students = [
            [
                'student_number' => '2023-0001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'gender' => 'Male',
                'birthdate' => '2000-05-15',
                'address' => '123 Main St, City',
                'contact_number' => '09123456789',
                'email' => 'john.doe@example.com',
                'program_id' => $programs->random()->program_id,
                'year_level' => 1,
                'status' => 'Enrolled',
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'student_number' => '2023-0002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'gender' => 'Female',
                'birthdate' => '2001-08-22',
                'address' => '456 Oak Ave, Town',
                'contact_number' => '09234567890',
                'email' => 'jane.smith@example.com',
                'program_id' => $programs->random()->program_id,
                'year_level' => 2,
                'status' => 'Enrolled',
                'user' => [
                    'name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'student_number' => '2023-0003',
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'gender' => 'Male',
                'birthdate' => '1999-11-10',
                'address' => '789 Pine St, Village',
                'contact_number' => '09345678901',
                'email' => 'michael.johnson@example.com',
                'program_id' => $programs->random()->program_id,
                'year_level' => 3,
                'status' => 'Enrolled',
                'user' => [
                    'name' => 'Michael Johnson',
                    'email' => 'michael.johnson@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'student_number' => '2023-0004',
                'first_name' => 'Emily',
                'last_name' => 'Williams',
                'gender' => 'Female',
                'birthdate' => '2002-03-05',
                'address' => '101 Cedar Rd, County',
                'contact_number' => '09456789012',
                'email' => 'emily.williams@example.com',
                'program_id' => $programs->random()->program_id,
                'year_level' => 1,
                'status' => 'Pending',
                'user' => [
                    'name' => 'Emily Williams',
                    'email' => 'emily.williams@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'student_number' => '2023-0005',
                'first_name' => 'David',
                'last_name' => 'Brown',
                'gender' => 'Male',
                'birthdate' => '2000-07-18',
                'address' => '202 Maple Dr, District',
                'contact_number' => '09567890123',
                'email' => 'david.brown@example.com',
                'program_id' => $programs->random()->program_id,
                'year_level' => 4,
                'status' => 'Enrolled',
                'user' => [
                    'name' => 'David Brown',
                    'email' => 'david.brown@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
        ];
        
        foreach ($students as $studentData) {
            $userData = $studentData['user'];
            unset($studentData['user']);
            
            // Create user
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => $userData['role'],
            ]);
            
            // Create student
            $studentData['user_id'] = $user->id;
            Student::create($studentData);
        }
        
        $this->command->info('Sample students created successfully.');
    }
} 