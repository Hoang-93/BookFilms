<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryfilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('categoryfilm');
        Schema::create('categoryfilm', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->timestamps();
        });

        Schema::table('categoryfilm', function (Blueprint $table) {
            $table->integer('Category_ID');
            $table->integer('Film_ID');
            $table->foreign('Category_ID')->references('ID')->on('category');
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
        Schema::dropIfExists('categoryfilm');
    }
}
