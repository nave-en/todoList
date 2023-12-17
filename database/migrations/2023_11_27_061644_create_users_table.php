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
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('email')->unique()->nullable();
            $table->date('date_of_birth');
            $table->integer('age');
            $table->timestamps();
            $table->index('email');
        });
        Log::info('users table has been successfully added to the database.');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Log::info('users table has been successfully dropped from the database.');
    }
};
