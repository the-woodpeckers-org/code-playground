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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->string('difficulty');
            $table->float('acceptance_rate');
            $table->integer('attempt_count')->default(0);
            $table->boolean('is_passed')->default(false);
            $table->timestamp('passed_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
        });

        Schema::create('testcases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->string('stdin');
            $table->string('expected_output');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testcases');
        Schema::dropIfExists('problems');
    }
};
