<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('club_member_id');
            $table->string('make');
            $table->string('model');
            $table->unsignedInteger('year');
            $table->unsignedInteger('capacity');
            $table->string('induction');
            $table->timestamps();
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('club_member_id')->references('id')->on('club_members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
