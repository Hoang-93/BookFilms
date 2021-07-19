<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('Point');
            $table->string('Name');
            $table->timestamps();
        });

        Schema::table('member', function (Blueprint $table) {
            $table->integer('User_ID');
            $table->foreign('User_ID')->references('ID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
