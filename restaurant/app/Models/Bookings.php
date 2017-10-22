<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
	protected $table = 'bookings';
    protected $fillable = ['id_bookings','name','email', 'phone', 'type'];
    public $timestamps = false;

    public function getBookedSeat()
    {
        return $this->hasOne('App\BookedSeat');
    }
}
