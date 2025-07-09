<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Models\Department;
use App\Models\Program;
use App\Services\ProgramService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProgramController extends Controller
{
    /**
     * The program service instance.
     *
     * @var ProgramService
     */
    protected $programService;

    /**
     * Create a new controller instance.
     *
     * @param ProgramService $programService
     * @return void
     */
    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
    }

    /**
     * Display a listing of the programs.
     *
     * @return View
     */
    public function index(): View
    {
        $programs = $this->programService->getAllPrograms();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     *
     * @return View
     */
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.programs.create', compact('departments'));
    }

    /**
     * Store a newly created program in storage.
     *
     * @param ProgramRequest $request
     * @return RedirectResponse
     */
    public function store(ProgramRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $program = Program::create($validatedData);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $departments = Department::all();
        return view('admin.programs.edit', compact('program', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramRequest $request, Program $program)
    {
        $validatedData = $request->validated();
        $program->update($validatedData);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
