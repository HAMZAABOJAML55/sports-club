<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

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
    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachments');
    }

    public function deleteFile($folder,$name)
    {

        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$folder.'/'.$name);
        }
    }


}
