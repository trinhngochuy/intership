<?php

namespace App\Repository;

use App\Models\Post;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Arr;
use function Sodium\add;

class PostRebository
{
    public function createPost($data)
    {
        $dataInsert=$this->getArrayInsert($data,false);
$post = Post::create($dataInsert);

        return $post;
    }
    public function updatePost($post,$data)
    {
        $dataInsert=$this->getArrayInsert($data,true,$post);
        $post->update($dataInsert);
        return $post;
    }
    public  function getArrayInsert($data,$update,$post=null){
        $dataInsert=[
            'title' => isset($data['title']) ? $data['title'] : '',
            'category_id' =>isset($data["category_id"]) ? $data["category_id"] : 0,
            'description'=> isset($data["description"]) ? $data["description"] : "",
            'created_at'=>  isset($data["created_at"])?$data["created_at"]:Carbon::now(),
            'content'=>isset($data["content"])?$data["content"]:'',
        ];
        if (!$update){
            $dataInsert=Arr::add($dataInsert, 'user_id' , isset($data["user_id"]) ?$data["user_id"]:0);
            $dataInsert=Arr::add($dataInsert, 'thumbnail' , isset($data["image"]) ? $this->UploadImage($data):Post::$default_thumbnail_url);
        }else{
            $dataInsert=Arr::add($dataInsert, 'slug' , isset($data["title"]) ? SlugService::createSlug(\App\Models\Post::class,'slug',$data["title"]):"");
            $dataInsert=Arr::add($dataInsert, 'thumbnail' , isset($data["image"]) ? $this->UploadImage($data):$post->thumbnail);
        }
        return $dataInsert;
    }
    public function UploadImage($data)
    {
        $input['image'] = time() . '.' . $data["image"]->extension();
        $data["image"]->move(public_path('user.img'), $input['image']);
        return '\user.img\\' . $input['image'];
    }
}
