<?php

namespace App\Http\Controllers;
use App\Http\Requests\AccountStore;
use App\Models\User;
use App\Repository\AccountRebository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use stdClass;
use Illuminate\Support\Facades\Request as Input;
use Throwable;



class AccountController extends Controller
{
    protected $accountRepository;

public function __construct()
{
    $this->accountRepository =  new AccountRebository();
}


    public function loginView(){

        return view("Account/AccountLogin");
    }
    public function login(Request $request){
  $user = [
      'user_name'=>$request->UserName,
      'password'=>$request->password,
  ];
      if (Auth::attempt($user)){
          return $this->responseSuccess("Login Successful!");
      }
        return $this->responseFail("Login fail!");
    }
    public function registerView(){
        return view("Account/AccountRegister");
    }
    public function creatAccount(AccountStore $request){
        try {
            $user = $this->accountRepository->createAccount($request->all());
        } catch (Throwable $e) {
            report($e);
            return view("viewAlert.Error",["message"=>"Sign Up Fail!"]);
        }
        return view("viewAlert.Success",["message"=>"Sign Up Success"]) ;
       }
    public function logOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("login.get");
    }



}


