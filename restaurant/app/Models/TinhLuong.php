<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhLuong extends Model
{
	protected $table = 'tinh_luong';
    protected $fillable = ['employer_id', 'month', 'luong_co_ban', 'phu_cap', 'ngay_cong_chuan', 'khoan_tru'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
	public function Employer () {
        return $this->belongsTo('App\Models\Employer', 'employer_id');
    }
}
