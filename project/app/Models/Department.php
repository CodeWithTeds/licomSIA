<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the instructors that belong to the department.
     */
    public function instructors(): HasMany
    {
        return $this->hasMany(Instructor::class);
    }

    /**
     * Get the programs that belong to the department.
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
