<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('club_member_id');
            $table->unsignedBigInteger('club_id');
            $table->string('name');
            $table->string('value')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });

        Schema::table('membership_types', function (Blueprint $table) {
            $table->foreign('club_member_id')->references('id')->on('club_members');
            $table->foreign('club_id')->references('id')->on('clubs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_types');
    }
}
