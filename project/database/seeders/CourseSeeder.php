<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all programs to associate with courses
        $programs = Program::all();
        
        if ($programs->isEmpty()) {
            $this->command->info('No programs found. Please run the ProgramSeeder first.');
            return;
        }

        // Get all instructors (optional)
        $instructors = Instructor::all();

        // CS Program courses
        $csProgram = $programs->where('program_name', 'Bachelor of Science in Computer Science')->first();
        if ($csProgram) {
            $csCourses = [
                [
                    'course_name' => 'Introduction to Computer Science',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                ],
                [
                    'course_name' => 'Data Structures and Algorithms',
                    'units' => 4,
                    'program_id' => $csProgram->program_id,
                ],
                [
                    'course_name' => 'Object-Oriented Programming',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                ],
                [
                    'course_name' => 'Database Systems',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                ],
                [
                    'course_name' => 'Operating Systems',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                ],
            ];

            foreach ($csCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
                // Set prerequisites (Data Structures requires Intro to CS)
                if ($index == 1 && isset($previousCourse)) {
                    $createdCourse->prerequisite_id = $previousCourse->course_id;
                    $createdCourse->save();
                }
                
                $previousCourse = $createdCourse;
                
                // Assign random instructor if available
                if ($instructors->isNotEmpty() && rand(0, 1)) {
                    $createdCourse->instructor_id = $instructors->random()->instructor_id;
                    $createdCourse->save();
                }
            }
        }

        // IT Program courses
        $itProgram = $programs->where('program_name', 'Bachelor of Science in Information Technology')->first();
        if ($itProgram) {
            $itCourses = [
                [
                    'course_name' => 'IT Fundamentals',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                ],
                [
                    'course_name' => 'Web Development',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                ],
                [
                    'course_name' => 'Network Administration',
                    'units' => 4,
                    'program_id' => $itProgram->program_id,
                ],
                [
                    'course_name' => 'System Administration',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                ],
                [
                    'course_name' => 'IT Project Management',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                ],
            ];

            foreach ($itCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
                // Set prerequisites (Web Dev requires IT Fundamentals)
                if ($index == 1 && isset($previousItCourse)) {
                    $createdCourse->prerequisite_id = $previousItCourse->course_id;
                    $createdCourse->save();
                }
                
                $previousItCourse = $createdCourse;
                
                // Assign random instructor if available
                if ($instructors->isNotEmpty() && rand(0, 1)) {
                    $createdCourse->instructor_id = $instructors->random()->instructor_id;
                    $createdCourse->save();
                }
            }
        }
    }
} 