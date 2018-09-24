<?php

use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * alap adatokkal tölti fel a daytypes és a daytypes_lang táblákat.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'Próba categoria 1'],
            [ 'Próba categoria 2'],
            [ 'Próba categoria 3'],
            [ 'Próba categoria 4'],
            [ 'Próba categoria 5'],
        ];
     //   $faker = Faker\Factory::create('en_US');
     $faker = Faker\Factory::create('hu_HU');
        foreach ($datas as $data) {
          $id=  DB::table('categories')->insertGetId([
                'name' => $data[0],
            ]);
     
        };
    }
}
