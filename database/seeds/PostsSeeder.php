<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * alap adatokkal tölti fel a daytypes és a daytypes_lang táblákat.
     *
     * @return void
     */
    public function run()
    {
  /*      $datas = [
            [1, 'Próbapost 1', 'images/kep1.jpg', 1],
            [2, 'Próbapost 2','images/kep2.jpg', 1],
            [3, 'Próbapost 3','images/kep3.jpg', 2],
            [4, 'Próbapost 4','images/kep4.jpg', 3],
            [5, 'Próbapost 5','images/kep5.jpg', 4],
        ];*/
     //   $faker = Faker\Factory::create('en_US');
    $faker = Faker\Factory::create('hu_HU');
    $i=1;
    for ($i=1; $i <12 ; $i++) { 
        $id=  DB::table('posts')->insertGetId([
              'categori_id' =>  rand(1, 5),
              'cim' => $faker->realText(rand(20, 50), 1),
              'image' => 'images/image_'.$i.'.jpg',
              'intro' => $faker->realText(rand(50, 100), 1),  
           'ptext' => $faker->realText(rand(200, 5000), 1),
           ]);
        # code...
    }
    }
    
}
