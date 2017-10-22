<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaralyEmployer extends Model
{
	protected $table = 'saraly_employer';
    protected $fillable = ['id', 'employer_id', 'saraly_id', 'ngay_cong', 'created_at'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
	public function Saraly(){
    	return $this->belongsTo('App\Models\Saraly','saraly_id');
    }
    public function Employer(){
    	return $this->hasOne('App\Models\Employer','employer_id');
    }
}
