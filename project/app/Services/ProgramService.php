<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProgramService
{
    /**
     * Get all programs
     *
     * @return Collection
     */
    public function getAllPrograms(): Collection
    {
        return Program::with('department')->orderBy('program_name')->get();
    }

    /**
     * Get program by ID
     *
     * @param int $id
     * @return Program|null
     */
    public function getProgramById(int $id): ?Program
    {
        return Program::with(['courses', 'department'])->find($id);
    }

    /**
     * Create a new program
     *
     * @param array $data
     * @return Program
     */
    public function createProgram(array $data): Program
    {
        try {
            return DB::transaction(function () use ($data) {
                return Program::create([
                    'program_name' => $data['program_name'],
                    'department_id' => $data['department_id'],
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Failed to create program: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing program
     *
     * @param Program $program
     * @param array $data
     * @return Program
     */
    public function updateProgram(Program $program, array $data): Program
    {
        try {
            return DB::transaction(function () use ($program, $data) {
                $program->update([
                    'program_name' => $data['program_name'],
                    'department_id' => $data['department_id'],
                ]);

                return $program;
            });
        } catch (\Exception $e) {
            Log::error('Failed to update program: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete a program
     *
     * @param Program $program
     * @return bool
     */
    public function deleteProgram(Program $program): bool
    {
        try {
            return DB::transaction(function () use ($program) {
                return $program->delete();
            });
        } catch (\Exception $e) {
            Log::error('Failed to delete program: ' . $e->getMessage());
            throw $e;
        }
    }
} 