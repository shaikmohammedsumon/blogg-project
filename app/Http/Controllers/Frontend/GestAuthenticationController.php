<?php


namespace App\Http\Controllers\Frontend;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GestAuthenticationController extends Controller
{
    public function register(){
        return view('frontend.auth.register');
    }


    public function register_post(Request $request){
        
        $request->validate([
            "*" => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),

        ]);
        return redirect()->route('gest.login')->with('register_success',"Register Complite");

    }


    public function login(){
        return view('frontend.auth.login');
    }


    public function login_post(Request $request){
        $request->validate([
            "*" => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){
            return redirect()->route('home');
        }else{
            return back()->withErrors(['email' => "user is not valid"])->withInput();
        }


    }
}
