<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->code, function (User $user) use ($permission) {
               $permissionIds = $this->getPermissionArray($user);
               if (in_array($permission->id, $permissionIds)&&$user->status==1){
                   return true;
               }
               return false;
            });
        }
    }
    /**
     * @param $user
     * @return mixed
     */
    public function getPermissionArray(User $user)
    {
        $cacheKey = "permission_ids_".$user->id;
        $permissionIds = Cache::get($cacheKey);
        if(!is_null($permissionIds)){
            return $permissionIds;
        }
        $user = User::where("id", "=", $user->id)->with(["roles", "roles.permissions"])->get();
        $permissionIds = $user
            ->pluck("roles")
            ->flatten()
            ->pluck("permissions")
            ->flatten()
            ->unique("id")
            ->pluck("id")->toArray();
        Cache::put($cacheKey, $permissionIds, 300);
        return $permissionIds;
    }
}
