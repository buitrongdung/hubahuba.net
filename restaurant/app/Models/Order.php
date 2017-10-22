<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
    protected $fillable = ['id', 'note', 'user_id', 'order_no', 'status', 'created_at', 'rand_number'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
	public function OrderItem(){
    	return $this->hasMany('App\Models\OrderItem','order_id');
    }
    public function User(){
    	return $this->belongsTo('App\Models\User','user_id');
    }
}
