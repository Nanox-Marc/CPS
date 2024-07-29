<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
      
        $username = $request->input('username');
        $password = $request->input('password');
        if(filter_var($username,FILTER_VALIDATE_EMAIL))
        {
            Auth::attempt([
                'email'=>$username,
                'password'=>$password
            ]);
        } else {
            Auth::attempt([
                'employee_id'=>$username,
                'password'=>$password
            ]);
        }

       $result = [
           'is_granted'=>false
       ];
       if(Auth::check())
       {
           $result['is_granted'] = true;
       };
    //    return redirect('/home');
    return json_encode($result);
    }

    
   

}
