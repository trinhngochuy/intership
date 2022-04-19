<?php

namespace App\Repository;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AccountRebository
{
    public function createAccount($data)
    {
$user = $this->getUser($data,false);
$dataInsert =[
    'user_name'=>$user->user_name,
    'password'=>$user->password,
    'first_name'=>$user->first_name,
    'last_name'=>$user->last_name,
    'email'=>$user->email,
    'birth_day'=>$user->birth_day,
    'thumbnail'=>$user->thumbnail,
    'status'=>$user->status,
    'created_at'=>$user->created_at,
    'updated_at'=>$user->updated_at,
];
        if($user!=null){
            $user = User::create($dataInsert);
            DB::insert('insert into role_users (role_id, user_id) values (?, ?)', [1, $user->id]);
            if(isset($data["role_admin"])){
                DB::insert('insert into role_users (role_id, user_id) values (?, ?)', [2, $user->id]);
            }
        }
        return $user;
    }
public function updateAccount($data,$user){
    $user = $this->getUser($data,true,$user);
    $dataInsert =[
        'user_name'=>$user->user_name,
        'password'=>$user->password,
        'first_name'=>$user->first_name,
        'last_name'=>$user->last_name,
        'email'=>$user->email,
        'birth_day'=>$user->birth_day,
        'thumbnail'=>$user->thumbnail,
        'status'=>$user->status,
        'created_at'=>$user->created_at,
        'updated_at'=>$user->updated_at,
    ];
    if($user!=null){
        $user->update($dataInsert);
        if(isset($data["role_user"])){
            DB::insert('insert into role_users (role_id, user_id) values (?, ?)', [1, $user->id]);
        }else{
            DB::table('role_users')
                ->where('user_id',"=", $user->id)
                ->where('role_id',"=",1)
                ->delete();
        }
        if(isset($data["role_admin"])){
            DB::insert('insert into role_users (role_id, user_id) values (?, ?)', [2, $user->id]);
        }else{
            DB::table('role_users')
                ->where('user_id',"=", $user->id)
                ->where('role_id',"=",2)
                ->delete();
        }
    }

    return $user;
}

public function getUser($data,$update,$userfind=null): ?User
{
    try {
        $user = ($update) ? $userfind : new User();
        isset($data["password"]) ? $user->setPasswordAttribute($data["password"]) : $user->password = "";
        if (isset($data["birthday"])) {
            $date = strtotime($data["birthday"]);
            $user->birth_day = date('Y-m-d H:i:s', $date);
        } else {
            $user->birth_day = "";
        }
        isset($data["first_name"]) ? $user->first_name = $data["first_name"] : $user->first_name = "";
        isset($data["last_name"]) ? $user->last_name = $data["last_name"] : $user->last_name = "";
        isset($data["email"]) ? $user->email = $data["email"] : $user->email = "";
        isset($data["user_name"]) ? $user->user_name = $data["user_name"] : $user->user_name = "";
        isset($data["status"]) ? $user->status = $data["status"] : $user->status = 1;
       if ($update==false){
           isset($data["image"]) ? $user->thumbnail = $this->uploadImage($data) : $user->thumbnail = User::$default_thumbnail_url;
       }else{
          if ( isset($data["image"])){
              $user->thumbnail = $this->uploadImage($data);
          }
       }
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
    } catch (Throwable $e) {
        report($e);
        return null;
    }

    return $user;
}
public function deleteAccount($user){
    try {
        DB::table('role_users')
            ->where('user_id',"=", $user->id)
            ->delete();
        $user->delete();
    } catch (Throwable $e) {
        report($e);
        return false;
    }
return true;
}
    public function uploadImage($data)
    {
        $input['image'] = time() . '.' . $data["image"]->extension();
        $data["image"]->move(public_path('user.img'), $input['image']);
        return '\user.img\\' . $input['image'];
    }
}
