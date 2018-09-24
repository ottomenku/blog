<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
     //   $this->call(CategoriSeeder::class);
     //   $this->call(PostsSeeder::class);
       // $this->call(UsersTableSeeder::class);
       // $this->call(RolesSeeder::class);
    $this->call(SliderSeeder::class);
        
    } 
}
