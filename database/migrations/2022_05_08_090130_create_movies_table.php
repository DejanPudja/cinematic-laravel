<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('director');
            $table->string('english_title');
            $table->string('actors');
            $table->string('genre');
            $table->integer('duration');
            $table->string('distributor');
            $table->string('country_of_origin');
            $table->integer('year_of_production');
            $table->text('description');
            $table->string('trailer');
            $table->string('coming_soon');
            $table->string('image');
            $table->date('broadcast_date');
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
        Schema::dropIfExists('movies');
    }
}
