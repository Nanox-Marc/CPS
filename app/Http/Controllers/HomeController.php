<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogActivity as LogActivity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    // public function myTestAddToLog()
    // {
    //     LogActivity::addToLog('My Testing Add to Log.');
    //     dd('log inserted successfully.');
    // }
    // /**
    //  * Show the application dashboard.
    //  * 
    //  * @return \Illuminate\Http\Response
    //  */
    // public function logActivity()
    // {
    //     $logs = LogActivity::logActivityLists();
    //     return view('pages.logs',compact('logs'));
    // }
}
