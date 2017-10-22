<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboDinings extends Model {
    protected $table = 'combo_dinings';
    protected $fillable = ['name', 'type', 'seat_table', 'seat_dining'];
    protected $dates = ['birthday'];
    
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}
