<?php

namespace App\Services;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstructorService
{
    /**
     * Get all instructors with their relationships
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllInstructors($perPage = 10)
    {
        return Instructor::with(['department', 'position'])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate($perPage);
    }

    /**
     * Get instructor by ID with relationships
     *
     * @param int $id
     * @return Instructor|null
     */
    public function getInstructorById(int $id): ?Instructor
    {
        return Instructor::with(['department', 'position', 'courses'])->find($id);
    }

    /**
     * Create a new instructor
     *
     * @param array $data
     * @return Instructor
     */
    public function createInstructor(array $data): Instructor
    {
        try {
            return DB::transaction(function () use ($data) {
                return Instructor::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'department_id' => $data['department_id'],
                    'position_id' => $data['position_id'],
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Failed to create instructor: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing instructor
     *
     * @param Instructor $instructor
     * @param array $data
     * @return Instructor
     */
    public function updateInstructor(Instructor $instructor, array $data): Instructor
    {
        try {
            return DB::transaction(function () use ($instructor, $data) {
                $instructor->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'department_id' => $data['department_id'],
                    'position_id' => $data['position_id'],
                ]);

                return $instructor;
            });
        } catch (\Exception $e) {
            Log::error('Failed to update instructor: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete an instructor
     *
     * @param Instructor $instructor
     * @return bool
     */
    public function deleteInstructor(Instructor $instructor): bool
    {
        try {
            return DB::transaction(function () use ($instructor) {
                // Check if instructor has assigned courses
                if ($instructor->courses()->count() > 0) {
                    throw new \Exception('This instructor cannot be deleted because they are assigned to courses.');
                }
                
                return $instructor->delete();
            });
        } catch (\Exception $e) {
            Log::error('Failed to delete instructor: ' . $e->getMessage());
            throw $e;
        }
    }
} 