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
        Schema::create('language_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('attempt_count')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_stats');
    }
};
