<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $table = 'order_items';
    protected $fillable = ['id', 'order_id', 'menu_id', 'amount', 'into_money'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
	public function Menu()
	{
		return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
	}
}
