<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
   public function uploadImage(Request $request){
$input['image']= time().'.'.$request->image->extension();
$request->image->move(public_path('user.img'),$input['image']);
return response()->json([
    'upload_image' => '<img id="thumbnail_image" src="\user.img\\'.$input['image'].'" alt="">',
]);
   }
}
