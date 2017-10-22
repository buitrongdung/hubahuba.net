<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Calendar extends Model
{

	protected $table = 'calendar';
    protected $fillable = ['id', 'employer_id', 'month', 'ngay_lam', 'year', 'ca_lam_viec', 'created_at'];
    public $timestamps = false;
    public function Employer () {
        return $this->belongsTo('App\Models\Employer', 'employer_id');
    }

    public function DetailEmployer ()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id_employer');
    }

}
