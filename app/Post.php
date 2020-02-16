<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\PostFilter;


class Post extends Model
{
	protected $guarded = [];
	

	public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeFilter($builder, PostFilter $filter)
    {
    	//$user = auth('api')->user();
        $filter->apply($builder);
    }
}