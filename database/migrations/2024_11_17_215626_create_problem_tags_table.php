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
        Schema::create('problem_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('problem_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_tags');
    }
};
