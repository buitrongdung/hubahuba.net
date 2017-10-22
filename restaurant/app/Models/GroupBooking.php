<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupBooking extends Model
{
	protected $table = 'groupbookings';
    protected $fillable = ['id', 'user_id', 'name', 'soluong', 'time', 'date', 'status', 'ad_note', 'created_at', 'rand_number'];
    protected $dates = ['birthday'];
    
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
    public $timestamps = false;

    public function ComboDinings ()
    {
        return $this->hasOne('App\Models\ComboDinings', 'name', 'id');
    }
}
