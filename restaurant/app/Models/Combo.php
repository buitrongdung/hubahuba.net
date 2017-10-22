<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
	protected $table = 'combo';
    protected $fillable = ['id', 'name', 'image', 'content', 'price'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}
