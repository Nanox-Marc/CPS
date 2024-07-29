<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogActivity as LogActivity;
use App\Models\Canteen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AddCanteenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Canteen::all();

        $id = Auth::user()->employee_id;
        $user = DB::table('user_roles')->where('user_id', $id)->first();
        $userID = $user->role_id;

        return view('pages.canteen')->with([
            'userID'=>$userID,
            'name'=>$name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
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
            'canteen_name'=>'required'
        ]);
        
        $canteen = new Canteen([
            'canteen_name' => $request->get('canteen_name'),
            'status' => $request->get('status')
        ]);

        LogActivity::action("ADD CANTEEN | Canteen: {$canteen->canteen_name}");

        $inputs = Request()->all();
        $checkCanteen = Canteen::where('canteen_name',$inputs['canteen_name'])->get();
        if(count($checkCanteen) > 0)
        {
            return redirect('/canteen')->with('canteen_exist', 'Canteen Already Exists!');
        }
        else{
            $canteen->save();
            return redirect('/canteen')->with('addedcanteen', 'Canteen has been Successfully Added!');
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
        $name = Canteen::find($id);
        return view('pages.canteen');
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
        $request->validate([
            'status'=>'required'
        ]);
        
        $name = Canteen::find($id);
        $name->status = $request->get('status');
        $name->save();
        $id = Canteen::all();

        LogActivity::action("UPDATE CANTEEN STATUS | Canteen: {$name->canteen_name}");

        return redirect()->route('Canteen.index')->with('canteenupdated', 'Status Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $name = Canteen::find($id);
        // $name->delete();
        // return redirect('/Canteen')->with('deleted', 'Canteen deleted Successfully');
    }
}
