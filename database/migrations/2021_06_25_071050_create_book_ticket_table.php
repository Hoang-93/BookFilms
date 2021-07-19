<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_ticket', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Date');
            $table->string('Time');
            $table->dateTime('CreatedDate');
            $table->string('Sit');
            $table->integer('CountTicket');
            $table->decimal('TotalPrice', $precision = 8, $scale = 2);
            $table->timestamps();
        });

        Schema::table('book_ticket', function (Blueprint $table) {
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
        Schema::dropIfExists('book_ticket');
    }
}
