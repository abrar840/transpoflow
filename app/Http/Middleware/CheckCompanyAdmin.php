<?php

namespace App\Http\Middleware;

use Closure;
use Error;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Support\Facades\Auth;

use App\Models\Company;
use App\Models\user;
class CheckCompanyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public $routeCompany;
  public function handle(Request $request, Closure $next)
{
    // Allow admin if already logged in
    if (Auth::guard('web')->check()) {
        return $next($request);
    }

    // Skip check if visiting admin login or routes without a company param
    if (
        $request->is('/login') ||
        $request->is('admin/*') ||
        !$request->route('company')
    ) {
        return $next($request);
    }

    // Allow if the route doesn't have a company parameter
    $this->routeCompany = $request->route('company');
    // if ($routeCompany) {
    //     @dd($routeCompany);// Skip check if no company in route
    // }

    // Check if logged-in end_user belongs to this company
    if (Auth::guard('end_user')->check()) {
        $user = auth()->guard('end_user')->user();

        if ($user->company && $user->company->id === $this->routeCompany->id) {
            return $next($request);
        }


        Auth::guard('end_user')->logout();
         return $next($request);
      
    }
 
 

 return $next($request);
}

}
