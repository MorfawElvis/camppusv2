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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->integer('expense_amount');
            $table->date('entry_date');
            $table->text('expense_description')->nullable();
            $table->unsignedInteger('enteredBy_id');
            $table->unsignedInteger('approvedBy_id')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
