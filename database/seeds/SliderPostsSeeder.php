<?php

use Illuminate\Database\Seeder;

class SliderPostsSeeder extends Seeder
{
    /**
     * alap adatokkal tölti fel a daytypes és a daytypes_lang táblákat.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [1, 'Próbakep 1', 'images/bg_1.jpg', 1],
            [2, 'Próbakep 2','images/bg_2.jpg', 1],
            [2, 'Próbakep 2','images/bg_3.jpg', 1],
            [2, 'Próbakep 2','images/bg_4.jpg', 1],
        ];
 $faker = Faker\Factory::create('hu_HU');
        foreach ($datas as $data) {
        $id=  DB::table('posts')->insertGetId([
              'categori_id' =>  rand(1, 5),
              'cim' => 'slider: '.$faker->realText(rand(20, 50), 1),
              'image' => $data[2],
              'intro' =>'slider intro: '. $faker->realText(rand(50, 100), 1),  
           'ptext' => $faker->realText(rand(200, 5000), 1),
           ]);
        # code...
    }
    }
    
}
