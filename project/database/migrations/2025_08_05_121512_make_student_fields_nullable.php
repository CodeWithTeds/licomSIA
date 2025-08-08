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
        Schema::table('students', function (Blueprint $table) {
            $table->date('birthdate')->nullable()->change();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('contact_number', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('birthdate')->nullable(false)->change();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->string('contact_number', 20)->nullable(false)->change();
        });
    }
};
