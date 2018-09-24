<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function memoryDB()
    {
        config(['database.default' => 'sqlite_testing']);
        \Artisan::call('migrate'); 
           \Artisan::call('db:seed'); 
    }

    public function migrationIfMemoryDB()
    {
       if(config('database.default')=='sqlite_testing') {
            \Artisan::call('migrate'); 
           \Artisan::call('db:seed'); 
       }
       
    }


}

