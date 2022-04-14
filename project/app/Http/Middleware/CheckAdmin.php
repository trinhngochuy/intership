<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('update-post')
        &&Gate::allows('create-post')
            &&Gate::allows('list-post-admin')
          &&Gate::allows('delete-post')
            &&Gate::allows('create-user')
           &&Gate::allows('update-user')
            &&Gate::allows('delete-user')    
    ){
        return $next($request);
       }
       else{
           abort(403);
       }

    }
}
