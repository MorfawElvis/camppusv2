<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('class_subject_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')->constrained('class_rooms');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_subject_assignments');
    }
};
