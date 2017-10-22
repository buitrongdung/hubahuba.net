<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Home extends Model
{
	protected $table = 'home';
    protected $fillable = ['id', 'name', 'type', 'image', 'content', 'created_at'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}
