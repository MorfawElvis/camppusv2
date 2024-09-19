<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('class_subject_assignments', function (Blueprint $table) {
            $table->integer('teaching_periods_per_week')->after('subject_id')->default(1);
        });
    }

    public function down()
    {
        Schema::table('class_subject_assignments', function (Blueprint $table) {
            $table->dropColumn('teaching_periods_per_week');
        });
    }
};
