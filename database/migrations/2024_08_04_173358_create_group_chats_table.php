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
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->foreignId('student_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('year_class_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('sender',['student','teacher'])->default('student');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_chats');
    }
};