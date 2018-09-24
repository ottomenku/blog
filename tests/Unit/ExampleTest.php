<?php

namespace Tests\Unit;

use Tests\TestCase;
//use  PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\DB;
use App\Worker;
class ExampleTest extends TestCase
{
    use CreatesApplication;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
     $this->memoryDB(); 
     
        \DB::table('workers')->insert([
            'id' => 14,
            'user_id' => 4,
            'fullname' => 'jjjpppppppppppppppppppppppppppppl',          
        ]);
       // Worker::findOrFail(1);
        $this->assertTrue(Worker::findOrFail(14)->id==14);
    }}

