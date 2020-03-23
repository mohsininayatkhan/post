<?php 
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class DeleteController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function delete(Request $request, $id)
	{        
        $post = Post::find($id);

        if ($post) {
            $user = $request->user();           

            if ($post->user_id == $user->id) {                
                if ($post->delete()) {
                    $directory = '/uploads/posts/'.$post->id;
                    if (File::exists(public_path($directory))) {
                        File::deleteDirectory(public_path($directory));    
                    }
                    
                }
                return response(null, 200);
            } else {
                $errors = [
                    'message' => 'Forbidden',
                    'errors' => [
                        ['Not allowed to delete this post']
                    ]
                ];
                return response($errors, 403);
            }
        } else {
            $errors = [
                'message' => 'Forbidden',
                'errors' => [
                    ['Post not found']
                ]
            ];
            return response($errors, 404);
        }
	}	
}