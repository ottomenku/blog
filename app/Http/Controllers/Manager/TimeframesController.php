<?php

namespace App\Http\Controllers\Manager;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Daytype;
use App\Timeframe;

class TimeframesController extends MoController
{

    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by


    protected $par = [
        'routes' => ['base' => 'manager/timeframes'],
        'view' => ['base' => 'crudbase', 'include' => 'manager.timeframes'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'cim' => 'Időkeretek',
        'show' => ['auto'], // a show file generálja a megjelenítést
        //  'show'=>[['colname'=>'id','label'=>'Id']]
    ];

    protected $base = [
        'obname' => '\App\Timeframe',
 
    ];
    protected $val = [
        'name' => 'required|max:200',
        'unit' => 'required|max:50',
        'long' => 'required',
        'note' => 'max:200',
        'pub' => 'max:4',
    ];

    public function create_set()
    {
        $this->BASE['data']['basedaytype'] = Daytype::get();
        $this->BASE['data']['checked_daytype'] = [5];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit_set()
    {

        $this->BASE['data']['basedaytype'] = Daytype::get();

        foreach ($this->BASE['data']->daytype as $role) {

            $checked_daytype[] = $role->id;
        }
        $this->BASE['data']['checked_daytype'] = $checked_daytype;
       
    }

    public function store_set()
    {
        $id = $this->BASE['ob']->id;
        $this->BASE['ob']->daytype()->attach($this->BASE['request']->daytype_id);
  
    }

    public function update_set()
    {
        $this->BASE['ob']->daytype()->sync($this->BASE['request']->daytype_id);
    }

    public function destroy_set()
    {
        $this->BASE['ob']->daytype()->detach($this->BASE['request']->daytype_id);

    }
}
