<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
class LoginAndRolesTest extends TestCase
{
 //   use DatabaseMigrations;
    /** @belépés és jogosultságok ellenőrzése */
    public function testLoginAndroles()
    {
       // putenv('DB_DEFAULT=sqlite_testing');
       \Session::start();
       // Auth::logout();
      
     $response = $this->call('POST', '/login', [
            'email' => 'user@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
        //  $this->assertEquals(200, $response->getStatusCode());
       $this->assertEquals(Auth::id(), 5);
        $this->assertEquals(Auth::user()->hasRole('worker'), true);
        $this->assertEquals(Auth::user()->hasRole('manager'), false);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), false);

        Auth::logout();
        $response = $this->call('POST', '/login', [
            'email' => 'manager@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
      //  echo '-----------kkkkkkkkkk-'.Auth::id();
        $this->assertEquals(Auth::id(), 2);
        $this->assertEquals(Auth::user()->hasRole('worker'), false);
        $this->assertEquals(Auth::user()->hasRole('manager'), true);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), true);
        Auth::logout();
        $response = $this->call('POST', '/login', [
            'email' => 'workadmin@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
        $this->assertEquals(Auth::id(), 3);
        $this->assertEquals(Auth::user()->hasRole('worker'), false);
        $this->assertEquals(Auth::user()->hasRole('manager'), false);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), true);
    }

}
