<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trajectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajectories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('career_trajectorie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trajectorie_id');
            $table->unsignedBigInteger('career_id');
            $table->timestamps();

            $table->unique(['trajectorie_id','career_id']);

            $table->foreign('trajectorie_id')->references('id')->on('trajectories')->onDelete('cascade');
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');

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
