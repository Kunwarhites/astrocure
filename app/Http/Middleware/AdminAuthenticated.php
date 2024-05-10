<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
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
        $user = auth()->guard('admin')->user();

        // Check if the user is an admin with isadmin value set to 1
        if ($user && $user->isadmin == 1) {
            return $next($request);
        }
        
        return redirect()->route('Admins.SuperAdmin.login')->with('error', 'Your are not Admin.');
    }
  


}
