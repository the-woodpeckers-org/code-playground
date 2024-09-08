<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->dropColumn('attempt_count');
            $table->dropColumn('is_passed');
            $table->dropColumn('passed_at');
        });

        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('problem_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('attempt_count')->default(0);
            $table->text('code');
            $table->timestamp('passed_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
        });

        Schema::table('testcases', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
