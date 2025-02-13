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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('price')->nullable();
            $table->string('area')->nullable();
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->string('posted_by')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('description')->nullable();
            $table->json('images')->nullable(); // Lưu mảng ảnh dưới dạng JSON
            $table->enum('type', ['room', 'roommate'])->default('room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
