<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next, ...$roles)
    {
        $roleIds = ['Admin' => 1, 'User' => 2];
        $allowedRoleIds = [];
        foreach ($roles as $role)
        {
           if(isset($roleIds[$role]))
           {
               $allowedRoleIds[] = $roleIds[$role];
           }
        }
        $allowedRoleIds = array_unique($allowedRoleIds); 
        if(Auth::check()) {
          if(in_array(Auth::user()->role, $allowedRoleIds)) {
            return $next($request);
          }
          else{
            abort(403, 'Unauthorized action.');
          }
        }
        else{
          return redirect('/');
        }

    }
}
