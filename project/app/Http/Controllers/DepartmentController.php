<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     *
     * @return View
     */
    public function index(): View
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created department in storage.
     *
     * @param DepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified department.
     *
     * @param Department $department
     * @return View
     */
    public function show(Department $department): View
    {
        return view('admin.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param Department $department
     * @return View
     */
    public function edit(Department $department): View
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified department from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        // Check if department has related records
        if ($department->instructors()->count() > 0 || $department->programs()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Cannot delete department because it has related instructors or programs.');
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
} 