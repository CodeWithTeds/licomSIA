<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Instructor;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $instructors = Instructor::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $times = [
            ['08:00', '09:30'],
            ['09:45', '11:15'],
            ['13:00', '14:30'],
            ['14:45', '16:15'],
        ];
        $rooms = ['Room 101', 'Room 102', 'Room 201', 'Room 202', 'Lab 1', 'Lab 2'];

        foreach ($courses as $course) {
            Schedule::create([
                'course_id' => $course->course_id,
                'day' => $days[array_rand($days)],
                'time_start' => $times[array_rand($times)][0],
                'time_end' => $times[array_rand($times)][1],
                'room' => $rooms[array_rand($rooms)],
            ]);
        }
    }
}
