<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use HasFactory;

    protected $primaryKey = 'admission_id';

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'middle_name',
        'suffix_name',
        'age',
        'gender',
        'date_of_birth',
        'civil_status',
        'citizenship',
        'mobile_number',
        'email',
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'father_occupation',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_occupation',
        'home_address',
        'barangay',
        'city',
        'province',
        'zipcode',
        'year_graduated',
        'religion',
        'expected_date_of_grad',
        'course_preferences',
        'scholarship',
        'disability',
        'admission_type',
        'last_school_attended',
        'program_id',
        'program_applied_for',
        'school_year_applied',
        'upload_requirements',
        'application_status',
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'user_id');
    }
}
