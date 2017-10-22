<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
	protected $table = 'introduce';
    protected $fillable = ['id_intro','name','description'];
    public $timestamps = false;

    public function getBookedSeat () 
    {
    	return $this->hasOne('App\BookedSeat');
    }
    /*
    public function getIntro()
    {
    	return BookedSeat::table('introduce')->where('id_introduce',$this->id_intro)->get();
    }
    */
}
