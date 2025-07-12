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
        $instructors = $this->instructorService->getAllInstructors(10); // 10 per page
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
        $validatedData = $request->validated();
        $instructor = Instructor::create($validatedData);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        return view('admin.instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.instructors.edit', compact('instructor', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $validatedData = $request->validated();
        $instructor->update($validatedData);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor deleted successfully.');
    }
}
