<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollment_courses', function (Blueprint $table) {
            $table->id('enrollment_course_id');
            $table->foreignId('enrollment_id')->constrained('enrollments', 'enrollment_id');
            $table->foreignId('course_id')->constrained('courses', 'course_id');
            $table->decimal('grade_midterm', 4, 2)->nullable();
            $table->decimal('grade_finals', 4, 2)->nullable();
            $table->string('remarks', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_courses');
    }
}; 