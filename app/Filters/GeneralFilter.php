<?php 
namespace App\Filters;

use Illuminate\Http\Request;

abstract class GeneralFilter
{
	protected $request;

	protected $builder;

	protected $filters;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function apply($builder)
	{
		$this->builder = $builder;		
		$request = $this->request->all();
		
		foreach ($request as $filter => $value) {
			if (in_array($filter, $this->filters) && method_exists($this, $filter)) {			
				$this->$filter($value);
			}		
		}		
		$this->builder;
	}	
}