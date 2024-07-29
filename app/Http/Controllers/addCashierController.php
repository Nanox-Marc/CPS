<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountRegistration as Account;
use App\Models\Canteen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hash;
use App\Helpers\LogActivity as LogActivity;

class addCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Account::all();
        
        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        // $UserID = $user->role_id;

        return view('pages.cashier_list')->with([
            // 'userID'=>$userID,
            'list'=>$list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inputs = Request()->all();
        $checkEmpNo = Account::where('emp_id',$inputs['emp_id'])->get();
        if(count($checkEmpNo) > 0)
        {
            echo 'emp_exist';
        }
        else{
            $isCreated = Account::create([
                'name'=>$request['name'],
                'role_id'=>$request['role_id'],
                'emp_id'=>$request['emp_id'],
                'canteen_id'=>$request['canteen_id'],
                'password'=>Hash::make('pass12345678')
            ]);
            LogActivity::action('ADDED CASHIER USER');
            echo 'created';
            // return view('pages.addCashier');
            // return view('pages.addCashier')->with('alert','alert');
        }
        

        // if($isCreated)
        // {
        //     echo "Account has been created!";
        // }
       
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
