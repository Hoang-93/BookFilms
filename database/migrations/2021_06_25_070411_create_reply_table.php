<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->text('Content');
            $table->dateTime('CreatedDate');
            $table->timestamps();
        });

        Schema::table('reply', function (Blueprint $table) {
            $table->integer('User_ID');
            $table->integer('Comment_ID');
            $table->foreign('User_ID')->references('ID')->on('users');
            $table->foreign('Comment_ID')->references('ID')->on('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply');
    }
}
