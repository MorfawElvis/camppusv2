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
        Schema::create('timetable_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('start_day_id')->constrained('weekdays');
            $table->foreignId('end_day_id')->constrained('weekdays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable_settings');
    }
};
