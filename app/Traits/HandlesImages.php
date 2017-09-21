<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:41 AM
 */

namespace App\Traits;


use App\Models\Picture;
use Illuminate\Http\Request;

trait HandlesImages
{

    public function handleImage(Request $request,$id){
        $fileName = explode('.',$request->file($this->picType)->getClientOriginalName());
        $extension = $request->file($this->picType)->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = $fileName[0] . '_' . time() .'.'. $extension;

        $request->file($this->picType)->storeAs($this->picPath,$fileNameToStore);

        Picture::create([
            'location' => $fileNameToStore,
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }

    public function defaultImage($id){
        Picture::create([
            'location' => 'placeHolder.jpg',
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }
}