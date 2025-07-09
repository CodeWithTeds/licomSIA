<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the positions.
     *
     * @return View
     */
    public function index(): View
    {
        $positions = Position::orderBy('name')->get();
        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new position.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created position in storage.
     *
     * @param PositionRequest $request
     * @return RedirectResponse
     */
    public function store(PositionRequest $request): RedirectResponse
    {
        Position::create($request->validated());

        return redirect()->route('admin.positions.index')
            ->with('success', 'Position created successfully.');
    }

    /**
     * Display the specified position.
     *
     * @param Position $position
     * @return View
     */
    public function show(Position $position): View
    {
        return view('admin.positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified position.
     *
     * @param Position $position
     * @return View
     */
    public function edit(Position $position): View
    {
        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified position in storage.
     *
     * @param PositionRequest $request
     * @param Position $position
     * @return RedirectResponse
     */
    public function update(PositionRequest $request, Position $position): RedirectResponse
    {
        $position->update($request->validated());

        return redirect()->route('admin.positions.index')
            ->with('success', 'Position updated successfully.');
    }

    /**
     * Remove the specified position from storage.
     *
     * @param Position $position
     * @return RedirectResponse
     */
    public function destroy(Position $position): RedirectResponse
    {
        // Check if position has related instructors
        if ($position->instructors()->count() > 0) {
            return redirect()->route('admin.positions.index')
                ->with('error', 'Cannot delete position because it has related instructors.');
        }

        $position->delete();

        return redirect()->route('admin.positions.index')
            ->with('success', 'Position deleted successfully.');
    }
} 