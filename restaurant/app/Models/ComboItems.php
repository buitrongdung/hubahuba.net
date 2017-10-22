<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ComboItems extends Model
{
	protected $table = 'combo_items';
    protected $fillable = ['id_menu', 'id_combo'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}