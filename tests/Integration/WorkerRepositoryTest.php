<?php
namespace Tests\integration;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
//use App\Repository\WorkerRepository;
//use Tests\CreatesApplication;
class WorkerRepositoryTest extends TestCase{

///use CreatesApplication;
private $undertest;
/*
public function __construct()
{
  //  $this->undertest=new WorkerRepository();
}*/
public function testBasicTest()
{
   // $this->memoryDB();
/*
    \DB::connection('mysql')->table('workers')->insert([
        'user_id' => 4,
        'fullname' => 'jjjjjjjjjllllllllll',          
    ]);*/
   $this->assertTrue(true);
}
}