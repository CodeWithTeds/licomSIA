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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_name', 100);
            $table->integer('units');
            $table->integer('prerequisite_id')->nullable();
            $table->integer('program_id');
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->timestamps();
            
            $table->foreign('instructor_id')
                ->references('instructor_id')
                ->on('instructors')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
