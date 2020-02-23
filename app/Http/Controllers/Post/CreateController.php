<?php 
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255']
        ]);
    }

	public function create(Request $request)
	{
		$this->validator($request->all())->validate();
		
		$post = Post::create([
            'title' => $request['title'],
            'user_id' => $request->user()->id
        ]);
		
		//return response($post->load('author'));
        return response($post->load('author')->load('items'));
	}	
}