<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
      /*  $user = factory(User::class)->create([
            'email' => 'root@dolgozo.com',
        ]);*/ //csinál egy dolgozót

    //   $this->browse(function ($browser) use ($user) {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'root@dolgozo.com')
                    ->type('password', 'aaaaaa')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->logout();
           /*         
             $browser->visit('/login')
                    ->type('email', 'worker@dolgozo.com')
                    ->type('password', 'aaaaaa')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->logout();
            */
           // $response = $this->call('GET', '/login');
            $browser->visit('/login')
                    ->type('email', 'user@dolgozo.com')
                    ->type('password', 'aaaaaa2')
                    ->press('Login')
                    ->assertPathIs('/login');
                   // ->assertEquals(200, $response->status());
        });
}
}