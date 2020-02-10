<?php

use App\Models\ClubMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('club_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('admin')->default(ClubMember::NON_ADMIN_USER);
            $table->timestamps();
        });

        Schema::table('club_members', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_members');
    }
}
