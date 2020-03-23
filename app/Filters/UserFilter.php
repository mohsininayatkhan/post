<?php 
namespace App\Filters;

use Illuminate\Http\Response;
use App\User;

class UserFilter extends GeneralFilter
{
	protected $filters = ['keyword', 'popularity'];	

	public function keyword($keyword)
	{		
		return $this->builder->where('name', $keyword);
	}

	public function profession($profession)
	{
		return $this->builder->where('profession', $profession);
	}
}