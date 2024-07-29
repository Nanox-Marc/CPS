<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Canteen;
use App\Models\userRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CanteenSVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();//data filtering 
        $canteen = $user->canteen_id; //changed column name
        $transaction = Transaction::where('canteen_id',$canteen)->get(); //changed column name
        $cashier = Transaction::where('canteen_id',$canteen)->count();
        $total = Transaction::where('canteen_id',$canteen)->count();
        $concessionaire = Transaction::where('canteen_id',$canteen)->value('canteen_id');
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
            // elseif ($currentMonth == 2){
            //     $cutOffEndInitial ="$currentMonth/28/$currentYear";
            // }
            // elseif ($currentMonth == 2){
            //     $cutOffEndInitial ="$currentMonth/29/$currentYear";
            // }
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
       
       
        $transactionCutOff = transaction::all()->groupBy('canteen_id')->map(function ($row) use ($cutOffStartInitial, $cutOffEndInitial){
            $id = Auth::user()->employee_id;
            $user = DB::table('user_roles')->where('user_id', $id)->first();//data filtering 
            $canteen = $user->canteen_id;
            $concessionaire = Transaction::where('canteen_id',$canteen)->value('canteen_id');


            


            return $row->where('canteen', $concessionaire)->whereBetween('date', [$cutOffStartInitial, $cutOffEndInitial])->sum('amount');
        });

       

        $transactionToday = transaction::all()->groupBy('canteen_id')->map(function ($row) use ($cutOffStartInitial, $cutOffEndInitial){
            $currentDay = Carbon::today()->day;
            $currentMonth = Carbon::today()->month;
            $currentYear = Carbon::today()->year;
            $id = Auth::user()->employee_id;
            $user = DB::table('user_roles')->where('user_id', $id)->first();//data filtering 
            $canteen = $user->canteen_id;
            $concessionaire = Transaction::where('canteen_id',$canteen)->value('canteen_id');
            $currentDate = "$currentMonth/$currentDay/$currentYear";
            return $row->where('canteen_id', $concessionaire)->where('date', $currentDate)->sum('amount');
        });
            // dd($transactionCutOff[$concessionaire]);
            $cutOffTotal = $transactionCutOff[$concessionaire];
            $cuntOffToday = $transactionToday[$concessionaire];
            // dd($cutOffTotal);
            return view('pages.canteensv')->with([
                'transaction'=>$transaction,
                'cashier' =>$cashier,
                'total' =>$total,
                'concessionaire' => $concessionaire,
                'userID'=>$userID,
                'cutOffTotal' => $cutOffTotal,
                'cutOffToday' => $cuntOffToday
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
