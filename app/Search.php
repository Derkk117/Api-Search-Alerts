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
    
    public function scopeSearches($query)
	{
		return $query->select('concept', 'alert_id');
	}

    public function scopeRecentSearches($query, $user)
    {
        return $query->select('concept', 'alert_id')->where('user_id', $user->id)->limit(3);
    }

    public function User()
    {
        $this->belongsTo('App\User');
    }
}
