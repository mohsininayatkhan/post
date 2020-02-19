<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Uploader {

	public static function file($request, $directory, $input, $name=null)
	{
		$url = null;

		$file = $request->file($input);

		if ($name === null) {
			$name = Str::random(15).'.'.$file->extension();;
		}

		$path = public_path($directory);

    	if (!File::isDirectory($path)) {
    		File::makeDirectory($path, 0777, true, true);
    	}

    	$path = $file->move($path, $name);

    	if ($path) {
            $url = url($directory.'/'.$name);
        }
        return $url;
	}
}