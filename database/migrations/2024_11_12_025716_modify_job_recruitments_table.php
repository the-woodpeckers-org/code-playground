<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_recruitments', function (Blueprint $table) {
            $table->string('location')->nullable(); // Địa điểm làm việc
            $table->date('deadline')->nullable(); // Hạn cuối nộp đơn
            $table->string('skill')->nullable(); // Kỹ năng yêu cầu
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     
    }
};
