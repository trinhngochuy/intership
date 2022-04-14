<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    static $default_thumbnail_url = '\user.img\defaul\default-thumbnail.png';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'password',
        'first_name',
        'last_name',
        'email',
        'birth_day',
        'thumbnail',
        'created_at',
        'updated_at',
        'status',
    ];
    public function scopeSearch($query,$data)
    {
        if (isset($data["key"])) {
            if ($data["key"] != null) {
                $query =  $query->where('user_name', 'Like', '%' . $data["key"] . '%');
            }
        }
        return $query;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public  function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles(){
        return $this->belongsToMany(Roles::class, 'role_users',"user_id","role_id");

    }

}
