<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateSlidesTable extends Migration
{
   // use SoftDeletes;
  //  protected $dates = ['deleted_at'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  Not complet in demo
         */
        Schema::create('slides', function(Blueprint $table) {
            $table->increments('id');
            $table->string('path'); 
            $table->string('cim')->nullable();
            $table->string('note')->nullable();
            $table->integer('prior')->nullable();
            $table->tinyInteger('pub')->default(0);
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
  
        Schema::drop('slides');
    }
}
