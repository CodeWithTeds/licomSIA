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
        Schema::table('instructors', function (Blueprint $table) {
            if (!Schema::hasColumn('instructors', 'email')) {
                $table->string('email')->after('last_name')->nullable();
            }
            if (!Schema::hasColumn('instructors', 'password')) {
                $table->string('password')->after('email')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['email', 'password']);
        });
    }
};
