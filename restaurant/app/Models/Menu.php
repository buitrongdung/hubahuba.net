<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{
	protected $table = 'menu';
    protected $fillable = ['id', 'name', 'image', 'content', 'price', 'id_type'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
    public function TypeMenu()
    {
    	return $this->belongsToMany('App\Models\TypeMenu');
    }
    public function OrderItem()
    {
        return $this->belongsTo('App\Models\OrderItem', 'menu_id', 'id');
    }
    // public function Order()
    // {
    // 	return $this->hasOne('App\Order');
    // }
    // public static function seclectMenuByType($menuIdType) 
    // {
    //     $instance = new static;
    //     return DB::table($instance->table)->where('id_type', '=', $menuIdType)->get();
    // }
}
