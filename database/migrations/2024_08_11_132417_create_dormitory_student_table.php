<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('dormitory_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dormitory_id');
            $table->unsignedBigInteger('student_id');
            $table->boolean('is_captain')->default(false);
            $table->timestamps();
            $table->foreign('dormitory_id')->references('id')->on('dormitories')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dormitory_student');
    }
};
