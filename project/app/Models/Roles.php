<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=["role_name","deleted_at","created_at","updated_at"];
    public function permissions(){
       // return $this->hasMany(RolePermission::class,"role_id","id");
        return $this->belongsToMany(Permission::class, 'role_permissions',"role_id","permission_id");
    }
}
