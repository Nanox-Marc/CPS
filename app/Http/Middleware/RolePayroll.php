<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\userRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolePayroll
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


        // 1 = Normal User
        // 2 = Payroll
        // 3 = Admin
        // 4 = Cashier

        // if($request->user() && $request->user()->account_type == '2'){
        //     return redirect('cps');
        // }

        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        $userID = $user->role_id;
        
        if($userID == '2'){
            return redirect('cps');
        }

        return $next($request);
    }
}
