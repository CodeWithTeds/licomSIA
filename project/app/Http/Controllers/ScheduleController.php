<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Course;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleService
     */
    protected $scheduleService;

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleService $scheduleService
     */
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Display a listing of the schedules.
     *
     * @return View
     */
    public function index(): View
    {
        $schedules = $this->scheduleService->getAllSchedules();
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     *
     * @return View
     */
    public function create(): View
    {
        $courses = Course::orderBy('course_name')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.schedules.create', compact('courses', 'days'));
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param ScheduleRequest $request
     * @return RedirectResponse
     */
    public function store(ScheduleRequest $request): RedirectResponse
    {
        try {
            $this->scheduleService->createSchedule($request->validated());
            return redirect()->route('admin.schedules.index')
                ->with('success', 'Schedule created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified schedule.
     *
     * @param Schedule $schedule
     * @return View
     */
    public function show(Schedule $schedule): View
    {
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule.
     *
     * @param Schedule $schedule
     * @return View
     */
    public function edit(Schedule $schedule): View
    {
        $courses = Course::orderBy('course_name')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.schedules.edit', compact('schedule', 'courses', 'days'));
    }

    /**
     * Update the specified schedule in storage.
     *
     * @param ScheduleRequest $request
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function update(ScheduleRequest $request, Schedule $schedule): RedirectResponse
    {
        try {
            $this->scheduleService->updateSchedule($schedule, $request->validated());
            return redirect()->route('admin.schedules.index')
                ->with('success', 'Schedule updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified schedule from storage.
     *
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function destroy(Schedule $schedule): RedirectResponse
    {
        try {
            $this->scheduleService->deleteSchedule($schedule);
            return redirect()->route('admin.schedules.index')
                ->with('success', 'Schedule deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
} 