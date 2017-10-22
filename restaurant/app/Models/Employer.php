<?php

namespace App\Models;

use App\Traits\FormatChamCong;
use App\Traits\FormatCustom;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use FormatCustom;
	protected $table = 'employer';
    protected $fillable = ['id_employer','type_employer', 'name', 'account' , 'level', 'image', 'birthday', 'cmnd', 'gender', 'phone', 'email', 'ethnic', 'religion', 'country', 'diploma', 'address'];
    public $timestamps = false;

    public function Calendar()
    {
        return $this->hasMany('App\Models\Calendar', 'employer_id', 'id_employer');
    }

    public function TypeEmployer ()
    {
        return $this->hasOne('App\Models\TypeEmployer', 'id_employer', 'type_employer');
    }

    public function ChamCong ()
    {
        return $this->hasMany('App\Models\ChamCong', 'employer_id', 'id_employer');
    }
}
