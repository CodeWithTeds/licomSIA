<?php

namespace App\Repositories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ScheduleRepository
{
    /**
     * Get all schedules with pagination
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllSchedules(int $perPage = 10): LengthAwarePaginator
    {
        return Schedule::with('course')
            ->orderBy('day')
            ->orderBy('time_start')
            ->paginate($perPage);
    }

    /**
     * Get schedules by course ID
     *
     * @param int $courseId
     * @return Collection
     */
    public function getSchedulesByCourse(int $courseId): Collection
    {
        return Schedule::where('course_id', $courseId)
            ->orderBy('day')
            ->orderBy('time_start')
            ->get();
    }

    /**
     * Find schedule by ID
     *
     * @param int $id
     * @return Schedule|null
     */
    public function findById(int $id): ?Schedule
    {
        return Schedule::with('course')->find($id);
    }

    /**
     * Create a new schedule
     *
     * @param array $data
     * @return Schedule
     */
    public function create(array $data): Schedule
    {
        return Schedule::create($data);
    }

    /**
     * Update a schedule
     *
     * @param Schedule $schedule
     * @param array $data
     * @return bool
     */
    public function update(Schedule $schedule, array $data): bool
    {
        return $schedule->update($data);
    }

    /**
     * Delete a schedule
     *
     * @param Schedule $schedule
     * @return bool
     */
    public function delete(Schedule $schedule): bool
    {
        return $schedule->delete();
    }

    /**
     * Check for schedule conflicts
     *
     * @param array $data
     * @param int|null $excludeId
     * @return bool
     */
    public function hasConflict(array $data, ?int $excludeId = null): bool
    {
        $query = Schedule::where('room', $data['room'])
            ->where('day', $data['day'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('time_start', [$data['time_start'], $data['time_end']])
                    ->orWhereBetween('time_end', [$data['time_start'], $data['time_end']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('time_start', '<=', $data['time_start'])
                            ->where('time_end', '>=', $data['time_end']);
                    });
            });
            
        if ($excludeId) {
            $query->where('schedule_id', '!=', $excludeId);
        }
        
        return $query->exists();
    }
} 