<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';
    protected $fillable = ['id', 'title', 'content', 'tag', 'alias' , 'summary', 'image', 'created_at', 'count_view', 'hight_light', 'show_hide', 'idea', 'admin_id', 'type_id'];
    public $timestamps = false;
    protected $guarded = ['_token', '_method'];//không cho file tên là _token và _method update
}
