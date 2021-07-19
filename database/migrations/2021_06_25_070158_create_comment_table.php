<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->text('Content');
            $table->integer('Rate');
            $table->dateTime('CreatedDate');
            $table->timestamps();
        });

        Schema::table('comment', function (Blueprint $table) {
            $table->integer('User_ID');
            $table->integer('Film_ID');
            $table->foreign('User_ID')->references('ID')->on('users');
            $table->foreign('Film_ID')->references('ID')->on('film');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
