<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamCong extends Model
{
    protected $table = 'cham_cong';
    protected $fillable = ['id', 'employer_id','month', 'year', 'ngay_cong'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update

    public function Employer()
    {
        return $this->belongsTo('App\Models\Employer', 'employer_id', 'id_employer');
    }

    public function Saraly()
    {
        return $this->hasMany('App\Models\Saraly', 'employer_id', 'employer_id');
    }
}
