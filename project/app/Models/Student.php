<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    
    protected $fillable = [
        'admission_id',
        'first_name',
        'last_name',
        'birth_date',
        'address',
        'contact',
        'program_id',
        'year_level',
        'status',
        'profile_complete',
        'user_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'profile_complete' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
} 