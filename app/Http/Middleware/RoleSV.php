<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\userRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleSV
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

        // if($request->user() && $request->user()->account_type == '4'){
        //     return redirect('terminal');
        // }

        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        
        

        $checkEmpNo = userRole::where('user_id',$id)->get();
        if(count($checkEmpNo) == 0)
        {
            $userID = "1";
        } else {
            $userID = $user->role_id;
            if($userID == '5'){
                return redirect('canteenSV');
            }
        }

        

        return $next($request);
    }
}
