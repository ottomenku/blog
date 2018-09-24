<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('prior')->nullable();
        //if havent lang table-------------
            $table->string('name');
            $table->string('note')->nullable();
            $table->tinyInteger('pub')->default(0);
        }); 

    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
   
        Schema::drop('categories');
    }
}
