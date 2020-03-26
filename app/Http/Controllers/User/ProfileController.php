<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Uploader;
use App\User;

class ProfileController extends Controller
{
	protected function validatorUploadPicture(array $data)
    {
    	// phhoto must be of specfic type and size should be less then 2 MB
        return Validator::make($data, [
            'photo' => [
            	'required', 
            	'mimes:jpeg,bmp,png', 
            	'max:2000'
            ]
        ]);
    }

    protected function validatorUserProfile(array $data)
    {
         return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['max:255'],
            'profession' => ['max:255'],
        ]);
    }

    public function uploadPicture(Request $request)
    {        
    	$this->validatorUploadPicture($request->all())->validate(); 

        $user = $request->user();
        $directory = '/uploads/users/'.$user->id;
        $code = 400;

        $url = Uploader::file($request, $directory, 'photo');

        if ($url) {
            $user->profile_picture = $url;
            $user->save();
            $code = 200;
        }
        return response(['url' => $url], $code);
    }

    public function getInfo($id)
    {
        return User::find($id);
    }

    public function updateProfile(Request $request)
    {
        $this->validatorUserProfile($request->all())->validate(); 

        $user = $request->user();

        $user->name = $request['name'];

        if (isset($request['gender'])) {
            $user->gender = $request['gender'];
        }

        if (isset($request['profession'])) {
            $user->profession = $request['profession'];
        }

        $user->save();
        return $user;
    }
}