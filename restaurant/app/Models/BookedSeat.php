<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookedSeat extends Model
{
    protected $table = 'booked_seats';
    protected $fillable = ['id_booked','id_bookings','id_days', 'id_introduce', 'status', 'guest', 'number'];
	public $timestamps = false;
    
    public function getDay()
    {
    	return $this->hasOne('App\Day','id_days','id_days');
        // hasOne('App/User', 'foreign_key', 'local-key'); quan hệ 1-1
    }
    public function getBooking()
    {
    	return $this->hasOne('App\Bookings','id_bookings','id_bookings');
    }
    public function getIntroduce()
    {
        return $this->hasOne('App\Introduce','id_intro','id_introduce');
    }
    /*public function getInfo()
    {
    	$info = $this->booking->name;
    	if($this->booking->phone)
    	{
    		$info = ', '.$this->booking->phone;
    	}
    	$info = ', '.$this->booking->email;
    	return $info;
    }*/
}
