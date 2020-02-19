<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Uploader;

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
}
