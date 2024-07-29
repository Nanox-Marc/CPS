<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\userRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleUser
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
        // 1 = Normal User
        // 2 = Payroll
        // 3 = Admin
        // 4 = Cashier

        
       
    


        $id = Auth::user()->employee_id;
        $checkEmpNo = userRole::where('user_id',$id)->get();
        if(count($checkEmpNo) == 0)
        {
            return redirect('user'); //wala role
        } 
        

        return $next($request);
    }
}
