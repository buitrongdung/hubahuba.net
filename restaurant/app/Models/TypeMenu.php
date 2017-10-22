<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TypeMenu extends Model
{
	protected $table = 'type_menu';
    protected $fillable = ['id', 'alias','name'];
    public $timestamps = false;
    public function Menu() {
    	return $this->belongsToMany('App\Models\Menu');
    }
    
}
