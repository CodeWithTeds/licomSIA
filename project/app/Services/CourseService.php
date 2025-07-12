<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseService
{
    /**
     * Get all courses with their relationships
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCourses($perPage = 10)
    {
        return Course::with(['program', 'instructor', 'prerequisite'])
            ->orderBy('course_name')
            ->paginate($perPage);
    }

    /**
     * Get course by ID with relationships
     *
     * @param int $id
     * @return Course|null
     */
    public function getCourseById(int $id): ?Course
    {
        return Course::with(['program', 'instructor', 'prerequisite'])->find($id);
    }

    /**
     * Create a new course
     *
     * @param array $data
     * @return Course
     */
    public function createCourse(array $data): Course
    {
        try {
            return DB::transaction(function () use ($data) {
                return Course::create([
                    'course_name' => $data['course_name'],
                    'units' => $data['units'],
                    'prerequisite_id' => $data['prerequisite_id'] ?? null,
                    'program_id' => $data['program_id'],
                    'instructor_id' => $data['instructor_id'] ?? null,
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Failed to create course: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing course
     *
     * @param Course $course
     * @param array $data
     * @return Course
     */
    public function updateCourse(Course $course, array $data): Course
    {
        try {
            return DB::transaction(function () use ($course, $data) {
                $course->update([
                    'course_name' => $data['course_name'],
                    'units' => $data['units'],
                    'prerequisite_id' => $data['prerequisite_id'] ?? null,
                    'program_id' => $data['program_id'],
                    'instructor_id' => $data['instructor_id'] ?? null,
                ]);

                return $course;
            });
        } catch (\Exception $e) {
            Log::error('Failed to update course: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete a course
     *
     * @param Course $course
     * @return bool
     */
    public function deleteCourse(Course $course): bool
    {
        try {
            return DB::transaction(function () use ($course) {
                // Check if this course is a prerequisite for other courses
                $hasPrerequisiteDependencies = Course::where('prerequisite_id', $course->course_id)->exists();
                
                if ($hasPrerequisiteDependencies) {
                    throw new \Exception('This course cannot be deleted because it is a prerequisite for other courses.');
                }
                
                return $course->delete();
            });
        } catch (\Exception $e) {
            Log::error('Failed to delete course: ' . $e->getMessage());
            throw $e;
        }
    }
} 