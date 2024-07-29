<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = $request->user();


        if (Auth::check()){

           
            if(($request->user() && $request->user()->account_status == '2')||($request->user() && $request->user()->account_status == '3')){
                Auth::logout();
                return redirect('login')->with('alert', 'Contact deleted!');
            } 

             
        }
        
        return $next($request);
    }
}
