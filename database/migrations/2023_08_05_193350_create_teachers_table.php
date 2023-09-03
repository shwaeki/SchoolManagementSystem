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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification',11);
            $table->date('birth_date')->nullable();
            $table->date('star_work_date')->nullable();
            $table->string('status')->default('persistent');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->enum('job_type', ['fullJob', 'partTime'])->nullable(); //new
            $table->boolean('work_afternoon')->default(false); //new
            $table->string('bank_name')->nullable(); //new
            $table->string('bank_branch')->nullable(); //new
            $table->string('bank_account')->nullable(); //new
            $table->text('id_photo')->nullable(); //new

            $table->text('notes')->nullable();
            $table->foreignId('school_class_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teachers');
    }
};
