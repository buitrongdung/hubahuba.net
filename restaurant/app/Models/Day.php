<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
	protected $table = 'days';
    protected $fillable = ['id_days','name','short'];
    public $timestamps = false;

    public function getBookedSeat()
    {
        return $this->hasOne('App\BookedSeat');
    }
}
