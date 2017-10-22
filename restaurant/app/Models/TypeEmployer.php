<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEmployer extends Model
{
	protected $table = 'type_employer';
    protected $fillable = ['id_employer', 'description'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update

    public function Employer() {
    	return $this->hasMany('App\Models\Employer', 'type_employer');
    }
    public function Saraly () {
    	return $this->belongsTo('App\Models\Saraly', 'id_type_employer');
    }
}
