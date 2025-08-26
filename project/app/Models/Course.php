<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'units',
        'program_id',
        'year_level',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructor', 'course_id', 'instructor_id')
            ->withTimestamps();
    }


    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'course_id', 'course_id');
    }

    public function enrollmentCourses()
    {
        return $this->hasMany(EnrollmentCourse::class, 'course_id', 'course_id');
    }

    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class, 'enrollment_courses', 'course_id', 'enrollment_id', 'course_id', 'enrollment_id')
            ->withPivot(['grade_midterm', 'grade_finals', 'remarks'])
            ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'course_id', 'course_id');
    }
}
