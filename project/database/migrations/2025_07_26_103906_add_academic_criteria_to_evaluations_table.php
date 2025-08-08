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
        Schema::table('evaluations', function (Blueprint $table) {
            $table->decimal('average_rating', 3, 2)->nullable()->after('comments');

            // Academic Criteria
            $table->tinyInteger('subject_mastery')->nullable()->after('average_rating');
            $table->tinyInteger('teaching_clarity')->nullable()->after('subject_mastery');
            $table->tinyInteger('student_engagement')->nullable()->after('teaching_clarity');
            $table->tinyInteger('fairness_of_grading')->nullable()->after('student_engagement');
            $table->tinyInteger('respect_for_students')->nullable()->after('fairness_of_grading');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn([
                'average_rating',
                'subject_mastery',
                'teaching_clarity',
                'student_engagement',
                'fairness_of_grading',
                'respect_for_students',
            ]);
        });
    }
};
