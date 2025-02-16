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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người nhận thông báo
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Bài đăng liên quan
            $table->string('title'); // Loại thông báo
            $table->string('content')->nullable(); // Nội dung thông báo
            $table->boolean('status')->default(false); // Trạng thái đã đọc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};