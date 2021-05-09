<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchInstance extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'alert_id', 'activate', 'page_name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $keyType = 'string';
    protected $table = 'search_instances';

    public function Alert()
    {
        return $this->belongsTo('App\Alert');
    }
}
