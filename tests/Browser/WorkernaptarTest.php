<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WorkernaptarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testworkernaptarsee()
    {
      /*  $user = factory(User::class)->create([
            'email' => 'root@dolgozo.com',
        ]);*/ //csinál egy dolgozót

        $this->browse(function ($browser) {
           
            $browser->visit('/login')
                    ->type('email', 'user@dolgozo.com')
                    ->type('password', 'aaaaaa')
                    ->press('Login')
                    ->assertPathIs('/home');
                   // ->assertEquals(200, $response->status());
            $browser->visit('/worker/naptar') 
            ->assertSourceHas('path:Bootstrap3.dashgum.crudbase name:base') 
            ->assertSourceHas('path:Bootstrap3.dashgum.crudbase name:index ') ;
            //->assertSee('path:Bootstrap3.dashgum.crudbase name:base');  
            // ->assertSeeIn('#testdata', ' path:Bootstrap3.dashgum.crudbase name:base') ;
 
        });
}
}