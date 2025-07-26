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
        'prerequisite_id',
        'program_id',
        'year_level',
        'instructor_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'instructor_id');
    }

    public function prerequisite()
    {
        return $this->belongsTo(Course::class, 'prerequisite_id', 'course_id');
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
