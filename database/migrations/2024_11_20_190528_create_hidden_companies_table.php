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
        Schema::create('hidden_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_user_id');
            $table->unsignedBigInteger('profile_company_id');
            $table->foreign('profile_user_id')->references('id')->on('profile_users');
            $table->foreign('profile_company_id')->references('id')->on('profile_companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hidden_companies_tables');
    }
};
