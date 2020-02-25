<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\PostFilter;


class Post extends Model
{
	protected $guarded = [];	

    public static function boot()
    {
        parent::boot();
        
        self::deleting(function($post) 
        {
             $post->items()->each(function($item)
             {
                $item->delete();
             });             
        });
    }

	public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function scopeFilter($builder, PostFilter $filter)
    {
    	//$user = auth('api')->user();
        $filter->apply($builder);
    }
}