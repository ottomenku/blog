<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categori_id');
             $table->foreign('categori_id')->references('id')->on('categories');
             
           
         //lang-----------  
        $table->string('cim'); 
        $table->string('image')->nullable();
        $table->string('hastag')->nullable();
        $table->integer('prior')->nullable();
        $table->string('intro')->nullable();
        $table->text('ptext');
        $table->tinyInteger('pub')->default(0);
        $table->timestamps();

        });
        //multilanguge (If need) ----------
       /* Schema::create('days_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('days');
            $table->string('lang')->default('en');
            $table->string('name')->nullable(); 
            $table->string('note')->nullable();
        });*/

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /* Schema::table('days_lang', function(Blueprint $table){
            $table->dropForeign(['day_id']);   
        });
        Schema::table('days', function(Blueprint $table){
            $table->dropForeign(['daytype_id']);   
        });
        
        Schema::dropIfExists('days_lang');*/
        Schema::drop('posts');
    }
}
