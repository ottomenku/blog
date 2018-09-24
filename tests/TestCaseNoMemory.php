<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;


abstract class TestCase extends BaseTestCase
{    
    
    use DatabaseMigrations;

public function setUp(): void
   {
     parent::setUp();
     $this->artisan('db:seed');
   }

    use CreatesApplication;
 public function memoryDB(Type $var = null)
{
    config(['database.default' => 'sqlite_testing']);
    \Artisan::call('migrate'); 
       \Artisan::call('db:seed'); 
}
} 