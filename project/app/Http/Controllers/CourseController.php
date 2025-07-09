<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Program;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    /**
     * The course service instance.
     *
     * @var CourseService
     */
    protected $courseService;

    /**
     * Create a new controller instance.
     *
     * @param CourseService $courseService
     * @return void
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the courses.
     *
     * @return View
     */
    public function index(): View
    {
        $courses = $this->courseService->getAllCourses();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     *
     * @return View
     */
    public function create(): View
    {
        $programs = Program::orderBy('program_name')->get();
        $instructors = Instructor::with(['department', 'position'])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
        $prerequisites = Course::orderBy('course_name')->get();

        return view('admin.courses.create', compact('programs', 'instructors', 'prerequisites'));
    }

    /**
     * Store a newly created course in storage.
     *
     * @param CourseRequest $request
     * @return RedirectResponse
     */
    public function store(CourseRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $course = Course::create($validatedData);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $programs = Program::all();
        $instructors = Instructor::all();
        return view('admin.courses.edit', compact('course', 'programs', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $validatedData = $request->validated();
        $course->update($validatedData);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
