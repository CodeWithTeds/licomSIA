<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $primaryKey = 'enrollment_id';
    
    protected $fillable = [
        'student_id',
        'school_year',
        'semester',
        'year_level',
        'date_enrolled',
        'status',
    ];
    
    protected $casts = [
        'date_enrolled' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function enrollmentCourses()
    {
        return $this->hasMany(EnrollmentCourse::class, 'enrollment_id', 'enrollment_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollment_courses', 'enrollment_id', 'course_id', 'enrollment_id', 'course_id')
            ->withPivot(['grade_midterm', 'grade_finals', 'remarks'])
            ->withTimestamps();
    }
} 