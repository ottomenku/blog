<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','prior','note','pub'];

    public function posts()
	{
		return $this->hasMany('App\Post');
	}
	
}
