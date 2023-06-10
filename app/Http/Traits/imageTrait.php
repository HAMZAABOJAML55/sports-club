<?php

namespace App\Http\Traits;

trait imageTrait
{
    function saveImage($photo,$folder)
    {
        if ($photo) {
            //save photo in folder
            $file_extension = $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = $folder;
            $photo->move($path, $file_name);

            return $file_name;
        }
        return null;
    }

}
