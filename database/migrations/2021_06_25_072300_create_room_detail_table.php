<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('room_detail');
        Schema::create('room_detail', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('Level');
            $table->integer('Row');
            $table->integer('Column');
            $table->decimal('Price', $precision = 8, $scale = 2);
            $table->timestamps();
        });

        Schema::table('room_detail', function (Blueprint $table) {
            $table->integer('Room_ID');
            $table->foreign('Room_ID')->references('ID')->on('room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_detail');
    }
}
