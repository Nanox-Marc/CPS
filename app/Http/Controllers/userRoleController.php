<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogActivity as LogActivity;

class userRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = userRole::all();

        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        $userID = $user->role_id;
        return view('pages.role_list')->with([
            'userID'=>$userID,
            'list'=>$list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        $userID = $user->user_id;

        $request->validate([
            'user_id'=>'required',
            'role_id'=>'required'
        ]);
        $userRole = userRole::all();
        $userRole = new userRole([
            'user_id' => $request->get('user_id'),
            'role_id' => $request->get('role_id'),
            'canteen_id' => $request->get('canteen_id')
        ]);

        LogActivity::action("ADD USER ROLE | UserID: {$userRole->user_id}, Role: {$userRole->roles->role} | {$userRole->canteen->canteen_name}");

        $inputs = Request()->all();
        $checkEmpNo = userRole::where('user_id',$inputs['user_id'])->get();
        if(count($checkEmpNo) > 0)
        {
            return redirect('/user')->with('addedRoleX', 'Contact saved!');
        } else {

            $roleUserId = $request->input('user_id');
            
            

            $checkUsers = DB::connection('mysql2')->select('select * from employees where employee_id = ?', [$roleUserId]);
            if(count($checkUsers) == 0){
                return redirect('/user')->with('addedRoleY', 'Contact saved!');
            } else {
                $id = Auth::user()->employee_id;
                $userRole->save();
                return redirect('/user')->with('addedRole', 'Contact saved!');
            }

            
        }

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'string', 'max:255', 'unique:userRole'],
        ]);
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
