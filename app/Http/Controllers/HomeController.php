<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Uur;
use Carbon\Carbon;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uur = Uur::all();
        return view('home', ['uur' => $uur]);
    }
    
    public function start()
    {
        $user = Auth::user();
        $user->ingechecked = 1;
        $user->save();
        
        DB::table('uren')->insert(
            ['users_id' => Auth::user()->id, 'datum' => Carbon::now()]
        );
        
        return redirect('/');
    }
    
    public function eind()
    {
        $user = Auth::user();
        $user->ingechecked = 0;
        $user->save();
        
        $uur = Uur::where('users_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        $uur->eindDatum = Carbon::now();
        $uur->save();
        
        return redirect('/');
    }
}
