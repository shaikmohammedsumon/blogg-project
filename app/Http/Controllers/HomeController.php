<?php

namespace App\Http\Controllers;

use App\Models\RequsetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $requests = RequsetModel::where('user_id', Auth::user()->id)->first();
        return view('dashborad.home.index',compact('requests'));
    }
}
