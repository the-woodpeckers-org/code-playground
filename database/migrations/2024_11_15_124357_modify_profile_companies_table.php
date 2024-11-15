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
        //
        Schema::table('profile_companies', function (Blueprint $table) {
            $table->text('description')->change();
            $table->text('general_information')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('profile_companies', function (Blueprint $table) {
            $table->string('description', 255)->change();
            $table->string('general_information', 255)->change();
        });
    }
};
