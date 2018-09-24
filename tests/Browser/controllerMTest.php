<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class controllerMTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testcontroller()
    {
        \Route::any('test/taskrun2', 'ControllerM@index');
        $response = $this->call('GET', 'test/taskrun2');     
        $ControllerM = \App::make('App\Http\Controllers\ControllerM');
        $this->assertTrue($ControllerM->PAR['base']['actualTask'] =='index');
        $this->browse(function ($browser) {
            $browser->visit('/test/taskrun2')
                    ->assertSee('index');
                  
        });
}
}