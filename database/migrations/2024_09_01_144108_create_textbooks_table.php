<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('textbooks', function (Blueprint $table) {
            $table->id();
            $table->string('subject_category');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->decimal('price', 10, 2);
            $table->foreignId('academic_year_id')->constrained('school_years')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('textbooks');
    }
};
