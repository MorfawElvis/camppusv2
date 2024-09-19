<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_textbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('textbook_id')->constrained('textbooks')->onDelete('cascade');
            $table->timestamp('collected_at')->useCurrent();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('student_textbooks');
    }
};
