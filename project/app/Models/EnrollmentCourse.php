<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentCourse extends Model
{
    use HasFactory;

    protected $primaryKey = 'enrollment_course_id';
    
    protected $fillable = [
        'enrollment_id',
        'course_id',
        'grade_midterm',
        'grade_finals',
        'remarks',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'enrollment_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
} 