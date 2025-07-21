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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id('admission_id');
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('suffix_name', 10)->nullable();
            $table->integer('age');
            $table->string('gender', 50);
            $table->date('date_of_birth');
            $table->string('civil_status', 50);
            $table->string('citizenship', 255);
            $table->string('mobile_number', 20);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('father_last_name', 100);
            $table->string('father_first_name', 100);
            $table->string('father_middle_name', 100)->nullable();
            $table->string('father_occupation', 100);
            $table->string('mother_last_name', 100);
            $table->string('mother_first_name', 100);
            $table->string('mother_middle_name', 100)->nullable();
            $table->string('mother_occupation', 100);
            $table->text('home_address');
            $table->string('barangay', 100);
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('zipcode', 10);
            $table->year('year_graduated')->nullable();
            $table->string('religion', 50);
            $table->string('expected_date_of_grad', 100)->nullable();
            $table->string('course_preferences', 100);
            $table->string('scholarship', 20)->nullable();
            $table->text('disability')->nullable();
            $table->string('admission_type', 50);
            $table->string('last_school_attended', 150);
            $table->string('program_applied_for', 100);
            $table->string('school_year_applied', 20);
            $table->text('upload_requirements')->nullable();
            $table->string('application_status', 20)->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
