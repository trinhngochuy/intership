<?php

use App\Events\CreatePost;
use App\Helpers\Libraries\RedisClient;
use App\Helpers\Libraries\RedisQueueLib;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ImageUploadController;
use App\Jobs\ProcessTest;
use App\Jobs\ProcessView;
use App\Mail\CreatePostMessage;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//, 'middleware' => ['auth.admin']
Route::group(['prefix' => 'admin/posts', 'middleware' =>'checkadmin'], function () {
    Route::get('/list', [App\Http\Controllers\Admin\PostController::class, 'index'])->name("admin.post.list");
    Route::get('/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name("admin.post.create.get");
    Route::post('/create', [App\Http\Controllers\Admin\PostController::class, 'createPost'])->name("admin.post.create.post");
    Route::get('/create_category', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategoryView'])->name("admin.post.update_category.get");
    Route::post('/update_category', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategoryPost'])->name("admin.post.update_category.post");
    Route::post('/delete_category', [App\Http\Controllers\Admin\CategoryController::class, 'deleteCategory'])->name("admin.post.delete_category.post");
    Route::post('/create_category', [App\Http\Controllers\Admin\CategoryController::class, 'createCategory'])->name("admin.post.create_category.post");
    Route::get('/update/{postId}', [App\Http\Controllers\Admin\PostController::class, 'updateView'])->name("admin.post.update.get");
    Route::post('/update', [App\Http\Controllers\Admin\PostController::class, 'updatePost'])->name("admin.post.update");
    Route::post('/search', [App\Http\Controllers\Admin\PostController::class, 'search'])->name("admin.post.search");
    Route::post('/delete', [App\Http\Controllers\Admin\PostController::class, 'deleteSoft'])->name("admin.post.delete.get");
    Route::get('/delete', [App\Http\Controllers\Admin\PostController::class, 'deleteView'])->name("admin.post.delete");
    Route::get('/list/user', [UserController::class, 'listUser'])->name("admin.get.list.user");
    Route::post('/create/user', [UserController::class, 'createUser'])->name("admin.post.create.user");
    Route::post('/change/user', [UserController::class, 'changeUser'])->name("admin.post.change.user");
    Route::post('/save-change/user', [UserController::class, 'saveChangeUser'])->name("admin.post.save-change.user");
    Route::post('/delete/user', [UserController::class, 'deleteUser'])->name("admin.post.delete.user");
    Route::post('/status/user', [UserController::class, 'changeStatus'])->name("admin.post.status.user");
    Route::post('/search/user', [UserController::class, 'searchUser'])->name("admin.post.search.user");
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AccountController::class, 'loginView'])->name("login.get");
    Route::post('/login', [AccountController::class, 'login'])->name("login");
    Route::get('/register', [AccountController::class, 'registerView'])->name("register.get");
    Route::post('/register', [AccountController::class, 'creatAccount'])->name("register");
});
Route::group(['prefix' => 'client/user', 'middleware' => 'auth'], function () {
    Route::get('/logout', [AccountController::class, 'logOut'])->name("logout");
    Route::get('/posts/create', [\App\Http\Controllers\User\PostController::class, 'create'])->name("client.post.create.get");
    Route::post('/posts/create', [\App\Http\Controllers\User\PostController::class, 'createPost'])->name("client.post.create.post");
    Route::get('/posts/update/{postId}', [\App\Http\Controllers\User\PostController::class, 'updateView'])->name("client.post.update.get");
    Route::post('/posts/update', [\App\Http\Controllers\User\PostController::class, 'updatePost'])->name("client.post.update.post");
    Route::get('/my-post', [\App\Http\Controllers\User\PostController::class, 'myPost'])->name("client.post.my.get");
    Route::post('/my-post/search', [\App\Http\Controllers\User\PostController::class, 'searchMyPost'])->name("client.post.my.search");
    Route::post('/my-post/delete', [\App\Http\Controllers\User\PostController::class, 'deleteSoft'])->name("client.post.delete");
    Route::post('/search', [\App\Http\Controllers\User\PostController::class, 'search'])->name("client.post.search");
    Route::post('/filter/categories', [\App\Http\Controllers\User\PostController::class, 'searchCategory'])->name("client.post.filter");
    Route::get('/posts', [\App\Http\Controllers\User\PostController::class, 'index'])->name("client.posts");
    Route::get('/posts/detail/{postslug}', [\App\Http\Controllers\User\PostController::class, 'postDetail'])->name("client.post.detail");
    Route::post('/posts/like', [\App\Http\Controllers\User\PostController::class, 'likePost'])->name("client.post.like");
});

Route::get('/', function () {

//    Mail::to("demo@gmail.com")->send(new CreatePostMessage());
//    dd("Email is Sent.");
    return view('Mail.create-post');
});
//    $arr= RedisQueueLib::getArrayQueue(env("QUEUE_LIKE"));
//
//    foreach ($arr as $item){
//        $data = json_decode($item["data"],TRUE);
//        $cases[] = " WHEN {$data["post_id"]} then `like` + 1";
//    }
//    $new = implode(' ', $cases);
//    DB::update("UPDATE posts SET `like` = CASE `id` {$new} ELSE `like` END");
