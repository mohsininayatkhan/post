<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Filters\PostFilter;
use Carbon\Carbon;

class SearchController extends Controller
{	
	public function search(Request $request, PostFilter $filter)
	{
		$input = $request->input();		
		$posts = Post::with('author')->with('items')->latest()->filter($filter);
		return $posts->simplePaginate(10)->appends($input);
	}
}