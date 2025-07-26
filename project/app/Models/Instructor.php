<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Authenticatable
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructors';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'instructor_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'department_id',
        'position_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the department that the instructor belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position that the instructor has.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the courses taught by the instructor.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id', 'instructor_id');
    }

    public function students()
    {
        // Get the IDs of courses taught by this instructor
        $courseIds = $this->courses()->pluck('course_id');

        // Get the enrollment IDs that include any of these courses
        $enrollmentIds = \App\Models\EnrollmentCourse::whereIn('course_id', $courseIds)
            ->pluck('enrollment_id');

        // Get the student IDs from these enrollments, where the status is 'Enrolled' or 'Approved'
        $studentIds = \App\Models\Enrollment::whereIn('enrollment_id', $enrollmentIds)
            ->whereIn('status', ['Enrolled', 'Approved'])
            ->pluck('student_id');

        // Return the student query builder for these student IDs
        return Student::whereIn('student_id', $studentIds);
    }

    public function schedules()
    {
        return $this->hasManyThrough(Schedule::class, Course::class, 'instructor_id', 'course_id', 'instructor_id', 'course_id');
    }

    public function today_schedules()
    {
        return $this->schedules()->where('day', now()->format('l'));
    }

    /**
     * Get the full name of the instructor.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the department name of the instructor.
     */
    public function getDepartmentNameAttribute(): string
    {
        return $this->department->name ?? '';
    }

    /**
     * Get the position name of the instructor.
     */
    public function getPositionNameAttribute(): string
    {
        return $this->position->name ?? '';
    }
}
