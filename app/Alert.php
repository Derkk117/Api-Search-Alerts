<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use SoftDeletes;

    protected $fillable = ['search_id', 'activate', 'schedule'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $keyType = 'string';
    protected $table = 'alerts';

    public function Search()
    {
        return $this->belongsTo('App\Search');
    }

    public function SearchInstances()
    {
        return $this->hasMany('App\SearchInstance');
    }
}
