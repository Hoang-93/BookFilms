<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Account', 250);
            $table->string('Password');
            $table->string('Fullname');
            $table->string('Address');
            $table->string('Phone');
            $table->string('Sex');
            $table->dateTime('BirthDay');
            $table->integer('Type');
            $table->boolean('Status');
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
        Schema::dropIfExists('users');
    }
}
