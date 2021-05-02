<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'concept', 'alert_id'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $keyType = 'string';
    protected $table = 'searches';

    public function User(){
        $this->belongsTo('App\User');
    }
}
