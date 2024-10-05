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
        Schema::create('participation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('contest_id')->unsigned();
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->integer('finished_problems')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });

        Schema::create('participation_attempts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('participation_id')->unsigned();
            $table->foreign('participation_id')->references('id')->on('participation')->onDelete('cascade');
            $table->bigInteger('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');

            $table->integer('attempt_count')->default(0);
            $table->text('code')->nullable();
            $table->timestamp('passed_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participation');
        Schema::dropIfExists('participation_attempts');
    }
};
