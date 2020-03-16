<?php 
namespace App\Filters;

use Illuminate\Http\Response;
use App\User;
use App\Thread;

class PostFilter extends GeneralFilter
{
	protected $filters = ['by', 'popularity'];

	/*public function by($email)
	{		
		$user = User::where('email', $email)->first();
		if($user) {
			return $this->builder->where('user_id', $user->id);	
		}		
	}*/

	public function by($id)
	{		
		return $this->builder->where('user_id', $id);
	}

	public function popularity($val)
	{
		$this->builder->getQuery()->orders = [];
		return $this->builder->orderBy('posts_count', 'desc');
	}
}