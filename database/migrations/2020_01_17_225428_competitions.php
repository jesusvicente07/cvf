<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Competitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('course_name');
            $table->string('link');
            $table->timestamps();

        });

        Schema::create('trajectorie_competition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trajectorie_id');
            $table->unsignedBigInteger('competition_id');
            $table->timestamps();

            $table->unique(['trajectorie_id','competition_id']);

            $table->foreign('trajectorie_id')->references('id')->on('trajectories')->onDelete('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
