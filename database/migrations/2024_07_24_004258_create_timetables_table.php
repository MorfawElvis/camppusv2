<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels');
            $table->foreignId('class_room_id')->constrained('class_rooms');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->unsignedTinyInteger('day_of_week');
            $table->unsignedTinyInteger('period_number');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timetables');
    }
};
