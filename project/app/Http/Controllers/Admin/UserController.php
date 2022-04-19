<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountStore;
use App\Models\User;
use App\Repository\AccountRebository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class UserController extends Controller
{
    private $accountRepository;
    protected $data;
    public function __construct(Request $request = null)
    {
        $this->accountRepository = new AccountRebository();
        $this->data = $request->all();
    }
    public function changeUser(){
        $user_id = $this->data["user_id"];
$user= User::find($user_id);
$user->roles = DB::table("role_users")->where("user_id","=",$user_id)->get()->pluck("role_id");
return $user;
    }
    public function saveChangeUser(Request $request){
        if (Gate::denies('update-user')) {
            abort(403);
        }
        $user = User::find($this->data["user_id"]);
        if ($user != null) {
            $user = $this->accountRepository->updateAccount($request->all(), $user);
        } else {
            return redirect()->route("admin.get.list.user")->with('message', 'User not find!')->with("error", " ");
        }
        return redirect()->route("admin.get.list.user")->with('message', 'Update successful!');
    }
    public function deleteUser(){
        if (Gate::denies('delete-user')) {
            abort(403);
        }
        $user_id = $this->data["user_id"];
        $user = User::find($user_id);
        if (!is_null($user)) {
            $result = $this->accountRepository->deleteAccount($user);
            if ($result == true) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    public  function changeStatus(){
        if (Gate::denies('update-user')) {
            abort(403);
        }
        $user_id = $this->data["user_id"];
        $user = User::find($user_id);
        if (!is_null($user)){
            if ($user->status==1){
                $user->update(["status"=>0]);
                return 0;
            }else{
                $user->update(["status"=>1]);
                return 1;
            }
        }
        else{
            return false;
        }
    }
    public function searchUser(){
        $users = User::query()->search($this->data)->get();
        return view("ListUser.ListUserSearch",["users"=>$users]);
    }
    public function listUser()
    {
        $users = User::all();
        return view("ListUser.List",["users"=>$users]);
    }
    public  function  createUser(AccountStore $request){
        if (Gate::denies('create-user')) {
            abort(403);
        }
        try {
            $user = $this->accountRepository->createAccount($request->all());
        } catch (Throwable $e) {
            report($e);
            return redirect()->route("admin.get.list.user")->with('message', 'created Fail!')->with("error", " ");
        }
        return redirect()->route("admin.get.list.user")->with('message', 'created successful!');

    }
}
