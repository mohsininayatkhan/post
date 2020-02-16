<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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

    	$userId = $request->user()->id;
    	$directory = '/uploads/users/'.$userId;
    	$path = public_path($directory);

    	if (!File::isDirectory($path)) {
    		File::makeDirectory($path, 0777, true, true);
    	}

    	$fileName = "test.jpg";
    	$path = $request->file('photo')->move($path, $fileName);
    	return response(['url' => url($directory.'/'.$fileName)], 200);
    }
}
