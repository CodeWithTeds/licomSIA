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
        $this->courseService->createCourse($request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $course = $this->courseService->getCourseById($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $course = $this->courseService->getCourseById($id);
        $programs = Program::orderBy('program_name')->get();
        $instructors = Instructor::with(['department', 'position'])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
        $prerequisites = Course::where('course_id', '!=', $id)
            ->orderBy('course_name')
            ->get();

        return view('admin.courses.edit', compact('course', 'programs', 'instructors', 'prerequisites'));
    }

    /**
     * Update the specified course in storage.
     *
     * @param CourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $this->courseService->updateCourse($course, $request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     *
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        $this->courseService->deleteCourse($course);

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
