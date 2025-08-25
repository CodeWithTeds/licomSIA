<?php

namespace App\Services;

use App\Models\Enrollment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnrollmentService
{
    /**
     * Get all enrollments with pagination and optional filters
     *
     * @param int|null $programId
     * @param int|null $yearLevel
     * @param string|null $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllEnrollments($programId = null, $yearLevel = null, $status = null, $perPage = 10): LengthAwarePaginator
    {
        $query = Enrollment::with(['student', 'student.program', 'enrollmentCourses.course'])
            ->orderBy('created_at', 'desc');
            
        if ($status) {
            $query->where('status', $status);
        }
        
        if ($programId) {
            $query->whereHas('student', function($q) use ($programId) {
                $q->where('program_id', $programId);
            });
        }
        
        if ($yearLevel) {
            $query->whereHas('student', function($q) use ($yearLevel) {
                $q->where('year_level', $yearLevel);
            });
        }
        
        return $query->paginate($perPage);
    }

    /**
     * Get pending enrollments with pagination
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPendingEnrollments($perPage = 10): LengthAwarePaginator
    {
        return Enrollment::with(['student', 'student.program', 'enrollmentCourses.course'])
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get enrollment by ID with relationships
     *
     * @param int $id
     * @return Enrollment|null
     */
    public function getEnrollmentById(int $id): ?Enrollment
    {
        return Enrollment::with(['student', 'student.program', 'enrollmentCourses.course'])
            ->find($id);
    }

    /**
     * Approve an enrollment
     *
     * @param Enrollment $enrollment
     * @return Enrollment
     */
    public function approveEnrollment(Enrollment $enrollment): Enrollment
    {
        try {
            return DB::transaction(function () use ($enrollment) {
                // Update enrollment status to Approved
                $enrollment->update([
                    'status' => 'Approved'
                ]);
                
                // You could also update the student status if needed
                // $enrollment->student->update(['status' => 'Enrolled']);
                
                return $enrollment;
            });
        } catch (\Exception $e) {
            Log::error('Failed to approve enrollment: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Reject an enrollment
     *
     * @param Enrollment $enrollment
     * @param string|null $reason
     * @return Enrollment
     */
    public function rejectEnrollment(Enrollment $enrollment, ?string $reason = null): Enrollment
    {
        try {
            return DB::transaction(function () use ($enrollment, $reason) {
                // Update enrollment status to Rejected
                $enrollment->update([
                    'status' => 'Rejected',
                    // If you want to store rejection reason, add a column to the enrollments table
                    // 'rejection_reason' => $reason
                ]);
                
                return $enrollment;
            });
        } catch (\Exception $e) {
            Log::error('Failed to reject enrollment: ' . $e->getMessage());
            throw $e;
        }
    }
}
