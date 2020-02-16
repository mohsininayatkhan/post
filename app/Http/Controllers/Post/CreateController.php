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
		$request['user_id'] = $request->user()->id;
		$post = $this->add($request);
		return response($post);
	}

	protected function add($data)
	{
		$post = Post::create([
            'title' => $data['title'],
            'user_id' => $data['user_id']
        ]);
		
		return $post->load('author');
	}
}