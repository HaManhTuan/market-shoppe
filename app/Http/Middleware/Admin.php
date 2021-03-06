<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admins')->check()) {
            $user = Auth::guard('admins')->user();
            if ($user->admin == 1){
               return $next($request);
            }
            else
              return redirect('manager/login');
             }
        else
        {
          return redirect('manager/login');
        }
    }
}
