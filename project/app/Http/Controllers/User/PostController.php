<?php

namespace App\Http\Controllers\User;
use App\Events\CreatePost;
use App\Helpers\Libraries\RedisQueueLib;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Models\Category;
use App\Models\Post;
use App\Repository\PostRebository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Throwable;
use function Symfony\Component\Translation\t;

class PostController extends Controller
{
    protected $postRepository;
    protected $data;
    public function __construct(Request $request)
    {
        $this->data = $request->all();
        $this->postRepository =  new PostRebository();
    }
    public function myPost()
    {
        $user = Auth::user();
        $posts = Post::where("user_id", "=", $user->id)->get();
        $categories = Category::all();
        return view("Client.MyPost", ["posts" => $posts, "categories_filter" => $categories]);
    }
public function likePost()
{
    $data = [
        "ip"=>gethostname(),
        "user_id"=>Auth::user()->id,
        "post_id"=>$this->data["post_id"],
        "created_at"=>Carbon::now()->format('Y-m-d H:i:s'),
    ];
    RedisQueueLib::push(env("QUEUE_LIKE"),"array","push",$data);
        return $this->data;
}
    public function searchMyPost(Request $request)
    {
        $user = Auth::user();
        $posts = Post::query()
            ->where("user_id", "=", $user->id)
            ->search($request)
            ->startDate($request)

            ->endDate($request)
            ->category($request)->get();
        return view("Client.PartalView.search", ["posts" => $posts]);
    }

    public function create()
    {
        $Categories = Category::all();
        return view("Client.AddPost", ['categories_create' => $Categories]);
    }
    public function updateView()
    {
        $postid = Route::getCurrentRoute()->parameter("postId");
        $post = Post::find($postid);
        $user = Auth::user();
        if ($post->user_id == $user->id){
            $Categories = Category::all();
            $link = route("client.post.update.post");
            return view("Client.AddPost",["categories_create"=>$Categories,"link"=>$link,"post"=>$post]);
        }else{
            return redirect()->route("client.posts")->with('message', 'you cannot access this page!')->with("error", " ");
        }
    }
    public function updatePost(PostStore $request)
    {
        try {
            $post = Post::find($request->id);
           if ($post != null){
               $post = $this->postRepository->updatePost($post,$request->all());
           }
           else{
               return redirect()->route("client.posts")->with('message', 'created Fail!')->with("error", " ");
           }
        } catch (Throwable $e) {
            report($e);
            return redirect()->route("client.posts")->with('message', 'created Fail!')->with("error", " ");
        }
        return redirect()->route("client.posts")->with('message', 'created successful!');
    }
    public function createPost(PostStore $request)
    {
        try {
            $post = $this->postRepository->createPost($request->all());
            if (is_null($post)) {
                return redirect()->route("client.posts")->with('message', 'created Fail!')->with("error", " ");
            }
            event(new CreatePost($post,Auth::user()));
        } catch (Throwable $e) {
            report($e);
            return redirect()->route("client.posts")->with('message', 'created Fail!')->with("error", " ");

        }
        return redirect()->route("client.posts")->with('message', 'created successful!');
    }

    public function index()
    {
        $Post = Post::query()->take(8)->get();
        $Categories = Category::all();
        return view("Client.Home", ["posts" => $Post, 'categories' => $Categories]);
    }

    public function postDetail()
    {
        $postslug = Route::getCurrentRoute()->parameter("postslug");
        $post = Post::where('slug', 'Like', '%' . $postslug . '%')->get();
if (!is_null($post)){
    $data = [
        "ip"=>gethostname(),
        "user_id"=>Auth::user()->id,
        "post_id"=>$post[0]->id,
        "created_at"=>Carbon::now()->format('Y-m-d H:i:s'),
    ];
    RedisQueueLib::push(env("QUEUE_VIEW"),"array","push",$data);
    $posts = Post::where("category_id", "=", $post[0]->category_id)->take(3)->get();
    return view("Client.Post_Detail", ["post" => $post, "posts" => $posts]);
}
        return redirect()->back();
    }

    public function search()
    {
        $posts = Post::query()->where("title", 'like', '%' . $this->data["key"] . '%')->get();
        return view('Client.search_client', ["posts" => $posts]);
    }

    public function searchCategory()
    {
        $posts = Post::all();
        if (isset($this->data["id"])) {
            $posts = Post::query()->where('category_id', '=', $this->data["id"])->get();
        }
        return view("Client.Category_search", ['posts' => $posts]);
    }

    public function deleteSoft()
    {
            if (isset($this->data["id"])) {
                $post = Post::find($this->data["id"]);
                $post->delete();
            }
    }
}
