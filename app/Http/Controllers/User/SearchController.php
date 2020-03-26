<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Filters\UserFilter;

class SearchController extends Controller
{
	public function search(Request $request, UserFilter $filter)
	{
		$input = $request->input();		
		$users = User::latest()->filter($filter);
		return $users->simplePaginate(10)->appends($input);
	}
}