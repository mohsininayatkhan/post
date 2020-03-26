<?php 
namespace App\Filters;

use Illuminate\Http\Response;
use App\User;

class UserFilter extends GeneralFilter
{
	protected $filters = ['keyword', 'profession', 'gender'];	

	public function keyword($value)
	{		
		return $this->builder->where('name', 'like', '%' . $value . '%');
	}

	public function profession($value)
	{		
		return $this->builder->where('profession', 'like', '%' . $value . '%');
	}

	public function gender($value)
	{
		return $this->builder->where('gender', $value);
	}
}