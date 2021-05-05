<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use SoftDeletes;

    protected $fillable = ['search_id', 'activate'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $keyType = 'string';
    protected $table = 'alerts';
}
