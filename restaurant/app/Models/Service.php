<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'service';
    protected $fillable = ['id_service', 'name', 'price'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
    public function Order()
    {
    	return $this->hasOne('App\Models\Order');
    }
}
