<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\userRole;
use Illuminate\Support\Facades\Auth;

class RfidController extends Controller
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
        $rfidNo = $request->input('rfdiSearch');

        $users = DB::connection('mysql2')->select('select * from rfids where rfid = ?', [$rfidNo]);
          
        if(count($users) == 0)
        {
            
            return redirect('/scan')->with('rfidError', 'Contact saved!');
        } else {
            $employeeId = $users[0]->user_id;
        
            $employeeInfo = DB::connection('mysql2')->select('select * from employees where employee_id = ?', [$employeeId]);

            $userName = Auth::user()->employee_id;
            $canteen = userRole::where('user_id', $userName )->get();

            return view('pages.terminal')->with([
                'rfidNo'=>$rfidNo,
                'employeeInfo'=>$employeeInfo,
                'canteen'=>$canteen
            ]);
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
