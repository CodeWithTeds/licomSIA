<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'evaluation_id';

    protected $fillable = [
        'instructor_id',
        'student_id',
        'semester',
        'school_year',
        'comments',
        'average_rating',
        'subject_mastery',
        'teaching_clarity',
        'student_engagement',
        'fairness_of_grading',
        'respect_for_students',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'instructor_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
