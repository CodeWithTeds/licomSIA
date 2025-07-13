<?php

namespace App\Services;

use App\Models\Schedule;
use App\Repositories\ScheduleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleService
{
    /**
     * @var ScheduleRepository
     */
    protected $scheduleRepository;

    /**
     * ScheduleService constructor.
     *
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * Get all schedules with pagination
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllSchedules(int $perPage = 10): LengthAwarePaginator
    {
        return $this->scheduleRepository->getAllSchedules($perPage);
    }

    /**
     * Get schedules by course ID
     *
     * @param int $courseId
     * @return Collection
     */
    public function getSchedulesByCourse(int $courseId): Collection
    {
        return $this->scheduleRepository->getSchedulesByCourse($courseId);
    }

    /**
     * Find schedule by ID
     *
     * @param int $id
     * @return Schedule|null
     */
    public function getScheduleById(int $id): ?Schedule
    {
        return $this->scheduleRepository->findById($id);
    }

    /**
     * Create a new schedule
     *
     * @param array $data
     * @return Schedule|null
     * @throws \Exception
     */
    public function createSchedule(array $data): ?Schedule
    {
        try {
            // Check for schedule conflicts
            if ($this->scheduleRepository->hasConflict($data)) {
                throw new \Exception('There is a scheduling conflict with the room at the specified time.');
            }

            return DB::transaction(function () use ($data) {
                return $this->scheduleRepository->create($data);
            });
        } catch (\Exception $e) {
            Log::error('Failed to create schedule: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update a schedule
     *
     * @param Schedule $schedule
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function updateSchedule(Schedule $schedule, array $data): bool
    {
        try {
            // Check for schedule conflicts (excluding current schedule)
            if ($this->scheduleRepository->hasConflict($data, $schedule->schedule_id)) {
                throw new \Exception('There is a scheduling conflict with the room at the specified time.');
            }

            return DB::transaction(function () use ($schedule, $data) {
                return $this->scheduleRepository->update($schedule, $data);
            });
        } catch (\Exception $e) {
            Log::error('Failed to update schedule: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete a schedule
     *
     * @param Schedule $schedule
     * @return bool
     * @throws \Exception
     */
    public function deleteSchedule(Schedule $schedule): bool
    {
        try {
            return DB::transaction(function () use ($schedule) {
                return $this->scheduleRepository->delete($schedule);
            });
        } catch (\Exception $e) {
            Log::error('Failed to delete schedule: ' . $e->getMessage());
            throw $e;
        }
    }
} 