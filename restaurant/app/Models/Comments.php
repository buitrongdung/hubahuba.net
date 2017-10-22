<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
	protected $table = 'comments';
    protected $fillable = ['id_comment', 'author', 'email', 'comment', 'news_id', 'date'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}
