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
        Schema::table('subscription_attributes', function (Blueprint $table) {
              $table->unsignedBigInteger('order_id')->nullable();
              $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
              $table->dropForeign(['user_id']);
              $table->dropColumn('user_id');
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
