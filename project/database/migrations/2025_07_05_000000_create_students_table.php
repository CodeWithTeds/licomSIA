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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_number', 20)->unique();
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('birthdate');
            $table->text('address');
            $table->string('contact_number', 20);
            $table->foreignId('program_id')->constrained('programs', 'program_id');
            $table->enum('status', ['Pending', 'Enrolled', 'Dropped', 'Graduated'])->default('Pending');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}; 