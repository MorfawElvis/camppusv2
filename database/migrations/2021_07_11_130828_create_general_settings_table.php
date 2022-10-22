<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable();
            $table->char('school_address')->nullable();
            $table->char('school_po_box')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_website')->nullable();
            $table->char('school_phone_number')->nullable();
            $table->char('school_logo')->nullable();
            $table->boolean('collapsed_sidebar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
