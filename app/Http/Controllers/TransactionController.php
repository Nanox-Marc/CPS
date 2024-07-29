<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use App\Models\userRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    
    public function userDisplay()
    {
        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        

       
        $checkEmpNo = userRole::where('user_id',$id)->get();
        if(count($checkEmpNo) == 0)
        {
            $userID = "1";
        } else {
            $userID = $user->role_id;
        }
        $transaction = Transaction::all();
        $userName = Auth::user()->employee_id;
        $transaction = transaction::where('employeeId', $userName )->get();
        $totalAmount = transaction::where('employeeId', $userName )->sum('Amount');
        $totalCount = transaction::where('employeeId', $userName )->count();

        return view('pages.user')->with([
            'transaction'=>$transaction,
            'totalAmount'=>$totalAmount,
            'totalCount'=>$totalCount,
            'userID'=>$userID
        ]);
    }

    public function cpsDisplay()
    {

        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();

        $currentDay = Carbon::today()->day;
        $currentMonth = Carbon::today()->month;
        $currentYear = Carbon::today()->year;
        if ($currentDay<=15){
            $cutOffStartInitial ="$currentMonth/01/$currentYear";
            $cutOffEndInitial ="$currentMonth/15/$currentYear";
        } else {
            $cutOffStartInitial ="$currentMonth/16/$currentYear";

            if($currentMonth == 1 || $currentMonth ==3 || $currentMonth == 5 || $currentMonth == 7 || $currentMonth == 8 || $currentMonth == 10 || $currentMonth == 12) {
                $cutOffEndInitial ="$currentMonth/31/$currentYear";
            }
            elseif ($currentMonth == 2){
                $cutOffEndInitial ="$currentMonth/28/$currentYear";
            }
            else {
                $cutOffEndInitial ="$currentMonth/30/$currentYear";
            }
            
        }

        $checkEmpNo = userRole::where('user_id',$id)->get();
        if(count($checkEmpNo) == 0)
        {
            $userID = "1";
        } else {
            $userID = $user->role_id;
        }
        $transactionNames = transaction::all()->groupBy('employeeId');
        $transactionCPS = transaction::all()->groupBy('employeeId')->map(function ($row) {
            $currentDay = Carbon::today()->day;
            $currentMonth = Carbon::today()->month;
            $currentYear = Carbon::today()->year;
            if ($currentDay<=15){
                $cutOffStart ="$currentMonth/01/$currentYear";
                $cutOffEnd ="$currentMonth/15/$currentYear";
            } else {
                $cutOffStart ="$currentMonth/16/$currentYear";
                $cutOffEnd ="$currentMonth/31/$currentYear";
            }
            // dd($cutOffStart);
            return $row->whereBetween('date', [$cutOffStart, $cutOffEnd])->sum('amount');
        });
        // $num = $mystuff->groupBy('dateDay');
        // $totalAmount = transaction::all()->sum('Amount');
        // $totalCount = transaction::all()->count();
        // dd($transactionCPS);
        return view('pages.cps')->with([
            'transactionCPS'=>$transactionCPS,
            'transactionNames'=>$transactionNames,
            'userID'=>$userID,
            'cutOffStart'=>$cutOffStartInitial,
            'cutOffEnd'=>$cutOffEndInitial
            // 'cutOffStart'=>$cutOffStart,
            // 'cutOffEnd'=>$cutOffEnd
            ]);
        //  return $transactionCPS;
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



        $request->validate([
            'cashierId'=>'required',
            'canteen_id'=>'required', //changed column name
            'employeeId'=>'required',
            // 'employeeName'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'time'=>'required'
        ]);

        $transaction = new transaction([
            'cashierId' => $request->get('cashierId'),
            'canteen_id' => $request->get('canteen_id'), //changed column name
            'employeeId' => $request->get('employeeId'),
            // 'employeeName' => $request->get('employeeName'),
            'amount' => $request->get('amount'),
            'date' => $request->get('date'),
            'time' => $request->get('time')
        ]);


        $rfidNo1 = $request->input('rfidFirst');
        $rfidNo2 = $request->input('rfidConfirmation');

        if($rfidNo1 == $rfidNo2){
            $transaction->save();
            return redirect('/scan')->with('transactionSuccess', 'Contact deleted!');
        } else {
            return redirect('/scan')->with('transactionFailed', 'Contact deleted!');
        }
        
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
