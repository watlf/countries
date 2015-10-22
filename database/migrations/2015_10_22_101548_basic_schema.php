<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction( function() {

            Schema::create('countries', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->timestamps();

                $table->unique('name');
            });

            Schema::create('cities', function(Blueprint $table) {
                $table->increments('id')->unsidned();
                $table->string('name');
                $table->timestamps();

                $table->unique('name');
            });

            Schema::create('languages', function(Blueprint $table) {
                $table->increments('id')->unsidned();
                $table->string('name');
                $table->char('alias', 3);
                $table->timestamps();

                $table->unique('name');
                $table->unique('alias');
            });

            Schema::create('country_cities_languages', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->bigInteger('country_id');
                $table->bigInteger('city_id');
                $table->bigInteger('language_id');

                $table->foreign('country_id')->references('id')->on('countries');
                $table->foreign('city_id')->references('id')->on('cities');
                $table->foreign('language_id')->references('id')->on('languages');

                $table->unique(['country_id', 'city_id', 'language_id']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('country_cities_languages');
    }
}
