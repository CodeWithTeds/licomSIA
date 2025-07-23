<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id')->nullable()->after('last_school_attended');
            $table->foreign('program_id')->references('program_id')->on('programs');
        });

        DB::transaction(function () {
            DB::statement("
                UPDATE admissions a
                JOIN programs p ON a.program_applied_for = p.program_name
                SET a.program_id = p.program_id
            ");
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('program_applied_for');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->string('program_applied_for')->nullable()->after('last_school_attended');
        });

        DB::transaction(function () {
            DB::statement("
                UPDATE admissions a
                JOIN programs p ON a.program_id = p.program_id
                SET a.program_applied_for = p.program_name
            ");
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};
