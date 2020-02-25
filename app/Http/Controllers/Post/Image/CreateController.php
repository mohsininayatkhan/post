<?php 
namespace App\Http\Controllers\Post\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helpers\Uploader;

class CreateController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photos.*' => [
            	'required', 
            	'mimes:jpeg,bmp,png', 
            	'max:2000'
            ]
        ]);
    }

	public function create(Request $request)
	{
        $this->validator($request->all())->validate();         

        $post = Post::create([
            'user_id' => $request->user()->id
        ]);

        $directory = '/uploads/posts/'.$post->id;
        $urls = Uploader::files($request, $directory, 'photos');

        if (count($urls)) {
            foreach ($urls as $url) {
                $post->items()->create([
                    'post_id' => $post->id, 
                    'type'  => 'image', 
                    'source' => $url
                ]);                
            }
        }        
        return response($post->load('author')->load('items'));
	}
	
}