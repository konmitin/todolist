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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("created_by");

            $table->unsignedBigInteger("assigned_by")->nullable();
            $table->unsignedBigInteger("closed_by")->nullable();

            $table->dateTime("closed_at")->nullable();

            $table->string("step_id", 255);
           
            $table->string("status", 50);

            $table->string("title", 100);
            $table->text("description")->nullable();
            $table->date('end_date')->nullable();

            $table->foreign('step_id')->references('id_all')->on('steps');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->foreign('closed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
