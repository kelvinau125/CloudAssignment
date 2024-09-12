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
        Schema::create('submission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('moduleID')->constrained('module')->onDelete('cascade')->onUpdate('cascade');
            $table->string('score');
            $table->string('maxscore'); 
            $table->string('sub_date'); 
            $table->string('feedback'); 
            $table->string('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission');
    }
};
