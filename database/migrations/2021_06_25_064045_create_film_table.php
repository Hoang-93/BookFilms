<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('review');
        Schema::create('film', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Name');
            $table->string('Metatitle');
            $table->string('Image');
            $table->string('Director');
            $table->string('Actor');
            $table->string('Time');
            $table->dateTime('ReleaseDate');
            $table->string('Country');
            $table->float('Vote');
            $table->integer('AgeRestriction');
            $table->text('Description');
            $table->string('Trailer');
            $table->boolean('Status');
            $table->timestamps();
        });

        Schema::table('film', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film');
    }
}
