<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saraly extends Model
{
	protected $table = 'saraly';
    protected $fillable = ['id', 'type_employer_id', 'luong_co_ban', 'phu_cap', 'ngay_cong_chuan', 'khoan_tru'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
	
	public function TypeEmployer(){
    	return $this->belongsTo('App\Models\TypeEmployer', 'id_employer');
    }
    public function SaralyEmployer () {
    	return $this->hasOne('App\Models\SaralyEmployer', 'saraly_id');
    }
}
