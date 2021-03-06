<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Models\Category;
use App\Models\Post;
use App\Repository\CategoryRebository;
use App\Repository\PostRebository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use League\Flysystem\Exception;
use Psy\Util\Json;
use Throwable;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
    protected $postRepository;
    protected $data;
    protected $arr;

    public function __construct(Request $request)
    {
        $this->data = $request->all();
        $this->postRepository = new PostRebository();
    }

    public function index()
    {
        if (Gate::denies('list-post-admin')) {
            abort(403);
        }
        $categories = Category::all();
        $posts = Post::all();
        return view("ListAdmin.List", ["posts" => $posts, 'categories' => $categories]);
    }
    public function search(Request $data)
    {
        $posts = Post::query()->search($data)->get();
       return view("ListAdmin.search", ["posts" => $posts]);
    }

    public function deleteView()
    {
        if (Gate::denies('delete-post')) {
            abort(403);
        }
        $id = $this->data["id"];
        return view("viewAlert.delete", ["id" => $id]);
    }

    public function deleteSoft()
    {
        if (Gate::denies('delete-post')) {
            abort(403);
        }
        $post = Post::find($this->data["id"]);
        try {
            $post->delete();
        } catch (Throwable $e) {
            return redirect("/admin/posts/list")->with('message', 'Delete Fail!')->with("error", " ");
        }
        return redirect("/admin/posts/list")->with('message', 'Delete Successful!');
    }

    public function create()
    {
        if (Gate::denies('create-post')) {
            abort(403);
        }
        $categories = Category::all();
        return view("CreateAdmin.create", ['categories_create' => $categories]);
    }

    public function updateView(Request $request)
    {
        if (Gate::denies('update-post')) {
            abort(403);
        }
        $post = null;
        $postId = Route::getCurrentRoute()->parameter("postId");
        if ($postId != null) {
            $post = Post::find($postId);
        }
        $categories = Category::all();
        $link = route("admin.post.update");
        return view("CreateAdmin.create", ["categories_create" => $categories, "link" => $link, "post" => $post]);
    }
    public function updatePost(PostStore $request)
    {
        if (Gate::allows('update-post')) {
            abort(403);
        }
        try {
            $post = Post::find($request->id);
            if ($post!=null){
                $post = $this->postRepository->updatePost($post,$request->all());
            }else{
                return redirect()->route("admin.post.list")->with('message', 'Update Fail!')->with("error", " ");
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->route("admin.post.list")->with('message', 'Update Fail!')->with("error", " ");
        }
        return redirect()->route("admin.post.list")->with('message', 'Update successful!');
    }

    public function createPost(PostStore $request)
    {
        if (Gate::denies('create-post')) {
            abort(403);
        }
        try {
            $post = $this->postRepository->createPost($request->all());
        } catch (Throwable $e) {
            report($e);
            return redirect()->route("admin.post.list")->with('message', 'created Fail!')->with("error", " ");
        }
        return redirect()->route("admin.post.list")->with('message', 'created successful!');
    }

}

