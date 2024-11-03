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
        Schema::table('cvs', function (Blueprint $table) {        
            $table->renameColumn('file_path', 'content');
            $table->text('content')->change()->nullable();
            $table->text('base64_content')->nullable(); // Mục đích scan content thành file rồi lưu vào cho show_pdf đỡ mất thời gian! nhưng tốn bộ nhớ =))
            $table->string('title');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
