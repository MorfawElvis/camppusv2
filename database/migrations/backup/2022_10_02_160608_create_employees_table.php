<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->unsignedInteger('user_id');
            $table->string('matriculation')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('gender');
            $table->string('highest_qualification');
            $table->string('position')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('denomination')->nullable();
            $table->date('date_of_employment')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_dismissed')->default(0);
            $table->boolean('is_retired')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('employees');
    }
};
