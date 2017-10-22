<?php
/*
namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function dining()
    {
    	return $this->hasOne('App\Dining','id','dining_id');
    }
    public function calc($day)
    {
    	$seats=count(BookedSeat::where('day_id',$day)->where('table_id',$this->id)->where('status','confirmed')->get());
    	$total= $this->seatspercompetitor  * $this->dining->competitors - $seats;
    	if($total>0) return $total;
    	return 0;
    }
    
    public function checkGroup($day)
    {
    	$seats=count(BookedSeat::where('day_id',$day)->where('table_id',$this->id)->get());
    	return $seats;
    }
}
