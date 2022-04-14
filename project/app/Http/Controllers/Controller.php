<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $data;
    public  function GetData(){
        return $this->data;
    }
public function __construct(Request $request = null)
{
    $this->data = $request->all();
}
    public function responseSuccess($message)
    {
        $route = route('client.posts');
        $view = view('viewAlert.Success', ['message' => $message])->render();
        return response()->json([
            "data" => $view,
            "status" => 1,
            "route" => $route,
        ]);
    }

    public function responseFail($message)
    {
        $view = view('viewAlert.Error', ['message' => $message])->render();
        return response()->json([
            "data" => $view,
            "status" => 0,

        ]);
    }
}

