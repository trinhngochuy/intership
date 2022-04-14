<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
    use HasFactory, SoftDeletes,Sluggable;
    static $default_thumbnail_url = '/user.img/defaul/default-post.jpg';
    protected $fillable = [
        'title',
        'description',
        'content',
        'thumbnail',
        'category_id',
        'user_id',
        'created_at',
        'slug',
        'updated_at',
    ];

    public function scopeSearch($query,$request)
    {
        if ($request->has("key")) {
            if ($request->key != null) {
                $query =  $query->where('title', 'Like', '%' . $request->key . '%');
            }
        }
            return $query;
        }
    public function scopeCategory($query,$request)
    {
        if ($request->has("category")) {
            if ($request->category != null) {
                $query = $query->where('category_id', '=', $request->category);
            }
        }
        return $query;
    }
public function scopeStartDate($query,$request)
{
    if ($request->has("start")) {
        $start = formatDate($request->start);
        if ($request->start != null) {

            $query = $query->where('posts.created_at', '>=', $start);
        }
    }
    return $query;
}
    public function scopeEndDate($query,$request)
    {
        if ($request->has("end")) {
            $end = formatDate($request->end);
            if ($request->end != null) {
                $query =  $query->where('posts.created_at', '<=', $end);
            }
        }
        return $query;
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

}

