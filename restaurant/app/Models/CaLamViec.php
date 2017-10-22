<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaLamViec extends Model
{
	protected $table = 'ca_lam_viec';
    protected $fillable = ['id', 'name', 'time'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
    public function Calendar () {
        return $this->belongsTo('App\Models\Calendar', 'ca_id');
    }
}
