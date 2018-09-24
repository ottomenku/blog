<?php
namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Handler\MoController;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Session;
use \App\Handler\trt\set\Orm; // with, where, order_by
class UsersController extends MoController
{
    use \App\Handler\trt\set\GetT;
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE 
   use \App\Handler\trt\set\Orm; // with, where, order_by
    protected $par= [
         'get_key'=>'user',
        'routes'=>['base'=>'manager/users'],
        //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
        'view'=> ['base' => 'crudbase', 'include' => 'manager.users','editform' => 'manager.users.edit_form'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'cim'=>'Felhasználók',
    ];
  
    protected $base= [
       // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'get'=>['modal'=>null], //a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be
       // 'get_post'=>['ev'=>null,'ho'=>null],//a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be ha van ilyen kulcs a postban azzal felülírja
        'obname'=>'\App\User',
        'ob'=>null,
        'orm'=>['with'=>['sajatroles']]

    ];


    protected $val= ['name' => 'required|unique:users,name', 'email' => 'required|unique:users,email', 'password' => 'required', 'roles' => 'required'];
    protected $val_update=  ['name' => 'required',  'email' => 'required', 'roles' => 'required'];
    //   !!!   update_set_data() ellenőrzi az unique-t mert a kivételhez változót kell használni (saját id)!!!
    

    public function create_set()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $this->BASE['data']['roles'] = $roles->pluck('name','id');
        $this->BASE['data']['user_roles'] = [4=>'worker'];
    }
    public function store_set_data()
    {
        $this->BASE['data']['password'] = bcrypt( $this->BASE['request']->password);
    }

    public function store_set()
    {
        $this->BASE['ob']->sajatroles()->attach($this->BASE['request']->roles);
    /*    foreach ($this->BASE['request']->roles as $role) {
            $user->assignRole($role);
        }*/
    }

 
    public function edit_set()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $this->BASE['data']['roles'] = $roles->pluck( 'name','id'); 
        $this->BASE['data']['user_roles'] = $this->BASE['data']->sajatroles ;
    }

    public function update_set_data()
    { 
        $this->validate($this->BASE['request'],[
        'name' => 'unique:users,name,'.$this->BASE['data']['id'],
        'email' => 'unique:users,email,'.$this->BASE['data']['id']]);
    }
    public function update_set()
    {     
 
        $this->BASE['ob']->sajatroles()->sync($this->BASE['data']['roles']);
    }

    public function destroy_set()
    {
 
        $this->BASE['ob']->sajatroles()->detach($this->BASE['request']->roles);

    }
  
}
