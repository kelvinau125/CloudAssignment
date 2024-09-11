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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('title');  // Content title
            $table->text('description');  // Content description
            $table->string('content_type');  // Either 'image' or 'video'
            $table->string('content_path')->nullable();  // Path to content (image/video)
            $table->softDeletes();
            $table->timestamps();  // Standard timestamps: created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
