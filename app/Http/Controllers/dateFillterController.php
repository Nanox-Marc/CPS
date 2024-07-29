<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use App\Models\userRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class dateFillterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cutOffStart = $request->input('cutOffStart');
        $cutOffEnd = $request->input('cutOffEnd');

        
        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();

        $checkEmpNo = userRole::where('user_id',$id)->get();
        if(count($checkEmpNo) == 0)
        {
            $userID = "1";
        } else {
            $userID = $user->role_id;
        }
        $transactionNames = transaction::all()->groupBy('employeeId');
        $transactionCPS = transaction::all()->groupBy('employeeId')->map(function ($row) use ($cutOffStart, $cutOffEnd){

            // dd($cutOffStart, $cutOffEnd);
            // $cutOffStarts = "2/22/2021";
            // $cutOffEnds = "2/22/2021";
            return $row->whereBetween('date', [$cutOffStart, $cutOffEnd])->sum('amount');
        });
        
        return view('pages.cps')->with([
            'transactionCPS'=>$transactionCPS,
            'transactionNames'=>$transactionNames,
            'userID'=>$userID,
            'cutOffStart'=>$cutOffStart,
            'cutOffEnd'=>$cutOffEnd
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
