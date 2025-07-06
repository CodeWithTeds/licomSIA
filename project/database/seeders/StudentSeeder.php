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
                'admission_id' => 10001,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'birth_date' => '2000-05-15',
                'address' => '123 Main St, City',
                'contact' => '09123456789',
                'program_id' => $programs->random()->program_id,
                'year_level' => 2,
                'status' => 'Enrolled',
                'profile_complete' => true,
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'admission_id' => 10002,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'birth_date' => '2001-08-22',
                'address' => '456 Oak Ave, Town',
                'contact' => '09234567890',
                'program_id' => $programs->random()->program_id,
                'year_level' => 1,
                'status' => 'Enrolled',
                'profile_complete' => true,
                'user' => [
                    'name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'admission_id' => 10003,
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'birth_date' => '1999-11-10',
                'address' => '789 Pine St, Village',
                'contact' => '09345678901',
                'program_id' => $programs->random()->program_id,
                'year_level' => 3,
                'status' => 'Enrolled',
                'profile_complete' => false,
                'user' => [
                    'name' => 'Michael Johnson',
                    'email' => 'michael.johnson@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'admission_id' => 10004,
                'first_name' => 'Emily',
                'last_name' => 'Williams',
                'birth_date' => '2002-03-05',
                'address' => '101 Cedar Rd, County',
                'contact' => '09456789012',
                'program_id' => $programs->random()->program_id,
                'year_level' => 1,
                'status' => 'Pending',
                'profile_complete' => false,
                'user' => [
                    'name' => 'Emily Williams',
                    'email' => 'emily.williams@example.com',
                    'password' => 'password123',
                    'role' => 'student'
                ]
            ],
            [
                'admission_id' => 10005,
                'first_name' => 'David',
                'last_name' => 'Brown',
                'birth_date' => '2000-07-18',
                'address' => '202 Maple Dr, District',
                'contact' => '09567890123',
                'program_id' => $programs->random()->program_id,
                'year_level' => 2,
                'status' => 'Enrolled',
                'profile_complete' => true,
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