<?php

use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
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
          $id=  DB::table('slides')->insertGetId([
                'cim' => $faker->realText(rand(20, 30), 1),
                'path' => $data[2],
            ]);
     
        };
    }
}
