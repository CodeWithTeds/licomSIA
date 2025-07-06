<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequest;
use App\Models\Department;
use App\Models\Instructor;
use App\Models\Position;
use App\Services\InstructorService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InstructorController extends Controller
{
    /**
     * The instructor service instance.
     *
     * @var InstructorService
     */
    protected $instructorService;

    /**
     * Create a new controller instance.
     *
     * @param InstructorService $instructorService
     * @return void
     */
    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    /**
     * Display a listing of the instructors.
     *
     * @return View
     */
    public function index(): View
    {
        $instructors = $this->instructorService->getAllInstructors();
        return view('admin.instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new instructor.
     *
     * @return View
     */
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('admin.instructors.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created instructor in storage.
     *
     * @param InstructorRequest $request
     * @return RedirectResponse
     */
    public function store(InstructorRequest $request): RedirectResponse
    {
        $this->instructorService->createInstructor($request->validated());

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor created successfully.');
    }

    /**
     * Display the specified instructor.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $instructor = $this->instructorService->getInstructorById($id);
        return view('admin.instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified instructor.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $instructor = $this->instructorService->getInstructorById($id);
        $departments = Department::orderBy('name')->get();
        $positions = Position::orderBy('name')->get();
        return view('admin.instructors.edit', compact('instructor', 'departments', 'positions'));
    }

    /**
     * Update the specified instructor in storage.
     *
     * @param InstructorRequest $request
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function update(InstructorRequest $request, Instructor $instructor): RedirectResponse
    {
        $this->instructorService->updateInstructor($instructor, $request->validated());

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor updated successfully.');
    }

    /**
     * Remove the specified instructor from storage.
     *
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function destroy(Instructor $instructor): RedirectResponse
    {
        $this->instructorService->deleteInstructor($instructor);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor deleted successfully.');
    }
}
