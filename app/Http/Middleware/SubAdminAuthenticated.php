<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->guard('subadmin')->user();

        // Check if the user is an admin with isadmin value set to 1
        if ($user && $user->isadmin == 0) {
            // return $next($request);
            return redirect()->route('subdashboard');
        }
        
        return redirect()->route('Admins.SuperAdmin.login')->with('error', 'Your are not SubAdmin.');
    }
}
