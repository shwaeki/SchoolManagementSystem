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
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('year_class_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
///*            $table->foreignId('academic_year_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('school_class_id')->constrained()->onUpdate('cascade')->onDelete('cascade');*/
            $table->foreignId('added_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};