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
                // First Year Courses
                [
                    'course_name' => 'Introduction to Computer Science',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Programming Fundamentals',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Discrete Mathematics',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Computer Organization',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 1,
                ],
                
                // Second Year Courses
                [
                    'course_name' => 'Data Structures and Algorithms',
                    'units' => 4,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Object-Oriented Programming',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Software Engineering',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Web Development',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 2,
                ],
                
                // Third Year Courses
                [
                    'course_name' => 'Database Systems',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Operating Systems',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Computer Networks',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Artificial Intelligence',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 3,
                ],
                
                // Fourth Year Courses
                [
                    'course_name' => 'Capstone Project I',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'Machine Learning',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'Information Security',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'Capstone Project II',
                    'units' => 3,
                    'program_id' => $csProgram->program_id,
                    'year_level' => 4,
                ],
            ];

            foreach ($csCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
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
                // First Year Courses
                [
                    'course_name' => 'IT Fundamentals',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Introduction to Programming',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Computer Hardware and Maintenance',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Web Development',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 1,
                ],
                
                // Second Year Courses
                [
                    'course_name' => 'Database Management',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Network Administration',
                    'units' => 4,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Object-Oriented Programming',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Mobile Application Development',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 2,
                ],
                
                // Third Year Courses
                [
                    'course_name' => 'System Administration',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Web Application Development',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Information Security',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 3,
                ],
                [
                    'course_name' => 'Cloud Computing',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 3,
                ],
                
                // Fourth Year Courses
                [
                    'course_name' => 'IT Project Management',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'IT Capstone Project I',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'Enterprise Architecture',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 4,
                ],
                [
                    'course_name' => 'IT Capstone Project II',
                    'units' => 3,
                    'program_id' => $itProgram->program_id,
                    'year_level' => 4,
                ],
            ];

            foreach ($itCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
                // Assign random instructor if available
                if ($instructors->isNotEmpty() && rand(0, 1)) {
                    $createdCourse->instructor_id = $instructors->random()->instructor_id;
                    $createdCourse->save();
                }
            }
        }
        
        // Business Administration Program courses
        $baProgram = $programs->where('program_name', 'Bachelor of Science in Business Administration')->first();
        if ($baProgram) {
            $baCourses = [
                // First Year Courses
                [
                    'course_name' => 'Introduction to Business',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Principles of Management',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Business Mathematics',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Business Communication',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 1,
                ],
                
                // Second Year Courses
                [
                    'course_name' => 'Financial Accounting',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Marketing Management',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Business Law',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Human Resource Management',
                    'units' => 3,
                    'program_id' => $baProgram->program_id,
                    'year_level' => 2,
                ],
            ];

            foreach ($baCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
                // Assign random instructor if available
                if ($instructors->isNotEmpty() && rand(0, 1)) {
                    $createdCourse->instructor_id = $instructors->random()->instructor_id;
                    $createdCourse->save();
                }
            }
        }
        
        // Elementary Education Program courses
        $eeProgram = $programs->where('program_name', 'Bachelor of Elementary Education')->first();
        if ($eeProgram) {
            $eeCourses = [
                // First Year Courses
                [
                    'course_name' => 'Introduction to Education',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Child Development',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Educational Psychology',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 1,
                ],
                [
                    'course_name' => 'Teaching Strategies',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 1,
                ],
                
                // Second Year Courses
                [
                    'course_name' => 'Curriculum Development',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Assessment of Learning',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Classroom Management',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 2,
                ],
                [
                    'course_name' => 'Teaching English in Elementary',
                    'units' => 3,
                    'program_id' => $eeProgram->program_id,
                    'year_level' => 2,
                ],
            ];

            foreach ($eeCourses as $index => $course) {
                $createdCourse = Course::updateOrCreate(
                    ['course_name' => $course['course_name'], 'program_id' => $course['program_id']],
                    $course
                );
                
                // Assign random instructor if available
                if ($instructors->isNotEmpty() && rand(0, 1)) {
                    $createdCourse->instructor_id = $instructors->random()->instructor_id;
                    $createdCourse->save();
                }
            }
        }
    }
} 