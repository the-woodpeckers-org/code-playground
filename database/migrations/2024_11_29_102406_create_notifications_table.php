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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('message');
            $table->unsignedBigInteger('fid');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }
    // user_id là người nhận
    // fid là loại trỏ đến bất kỳ bảng nào
    // type loại thông bảng
    // message nội dung thông báo
    // is_read là trạng thái thông báo đã đọc hay chưa
    

    /**
      */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
