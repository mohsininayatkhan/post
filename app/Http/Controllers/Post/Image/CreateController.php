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
            'photo' => [
            	'required', 
            	'mimes:jpeg,bmp,png', 
            	'max:2000'
            ]
        ]);
    }

	public function create(Request $request)
	{
        $user = $request->user();
        $directory = '/uploads/posts/'.$user->id;
        $code = 400;
        $items = [];        

        $urls = Uploader::files($request, $directory, 'photos');

        $post = Post::create([
            'user_id' => $request->user()->id
        ]);

        if (count($urls)) {
            foreach ($urls as $url) {
                $post->items()->create([
                    'post_id' => $post->id, 
                    'type'  => 'image', 
                    'source' => $url
                ]);                
            }
        }

        $post->items()->saveMany($items);
        return response($post->load('author')->load('items'));
	}
	
}