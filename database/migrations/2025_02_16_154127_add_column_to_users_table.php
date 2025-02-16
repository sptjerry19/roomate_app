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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->nullable();
            $table->integer('age')->nullable()->unsigned()->check('age >= 1 AND age <= 150');
            $table->string('hometown', 255)->nullable();
            $table->string('job', 255)->nullable();
            $table->string('workplace', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'age', 'hometown', 'job', 'workplace']);
        });
    }
};