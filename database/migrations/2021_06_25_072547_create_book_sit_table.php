<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_sit', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Sit');
            $table->integer('Type');
            $table->timestamps();
        });

        Schema::table('book_sit', function (Blueprint $table) {
            $table->integer('BookTicket_ID');
            $table->integer('RoomDetail_ID');
            $table->foreign('BookTicket_ID')->references('ID')->on('book_ticket');
            $table->foreign('RoomDetail_ID')->references('ID')->on('room_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_sit');
    }
}
