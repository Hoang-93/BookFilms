<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookFdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_fd', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('Quantity');
            $table->decimal('TotalPrice', $precision = 8, $scale = 2);
            $table->timestamps();
        });

        Schema::table('book_fd', function (Blueprint $table) {
            $table->integer('BookTicket_ID');
            $table->integer('FoodDrink_ID');
            $table->foreign('BookTicket_ID')->references('ID')->on('book_ticket');
            $table->foreign('FoodDrink_ID')->references('ID')->on('food_drink');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_fd');
    }
}
