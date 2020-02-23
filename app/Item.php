<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{	
	protected $guarded = [];
	
	public function post()
	{
		return $this->belongsTo('App\Post', 'post_id');
	}
}