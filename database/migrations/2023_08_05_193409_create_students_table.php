<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification', 11)->nullable();
            $table->enum('identification_type', ['israel_id','palestinian_id','passport','birth_report'])->default('israel_id');
            $table->date('birth_date');
            $table->string('birth_place')->nullable();
            $table->string('status')->nullable();
            $table->string('family_status')->defaut('unspecified');
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_id', 11)->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_id', 11)->nullable();
            $table->enum('custody', ['mother', 'father','unspecified'])->default('unspecified');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_house_no')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('family_members')->nullable();
            $table->enum('transportation_type', ['parents','bus'])->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('students');
    }
};
