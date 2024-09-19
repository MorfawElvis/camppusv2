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
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('dormitory_id')->nullable()->after('class_room_id');

            // Optional: Add a foreign key constraint if you want referential integrity
            $table->foreign('dormitory_id')->references('id')->on('dormitories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['dormitory_id']); // Drop the foreign key first if it exists
            $table->dropColumn('dormitory_id');
        });
    }
};
