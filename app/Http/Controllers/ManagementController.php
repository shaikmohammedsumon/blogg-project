<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role',"manager")->get();
        $bloggers = User::where('role',"blogger")->get();
        $users = User::where('role',"user")->get();
        return view('dashborad.management.auth.register',compact('managers','bloggers','users'));

    }




    public function store_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);

        if(!$request->role ==  ""){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
                'role' => $request->role,
                'created_at' => now(),
            ]);
            return back()->with('create_user',"Create $request->role Successful");
        }else{
            return back()->withErrors(['role'=> "please, select role frist "])->withInput();
        }


    }

    public function edit($edit){
        $manager = User::where('id',$edit)->first();
        return view('dashborad.management.auth.update',compact('manager'));
    }


    public function update(Request $request , $update){
        $manager = User::where('id',$update)->first();
        User::find($manager->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'updated_at' => now(),
        ]);
        return redirect()->route('management.index')->with('create_user', 'Manager Update Succesful');
    }


    public function delete($delete){
        $manager = User::where('id',$delete)->first();
        User::find($manager->id)->delete();
        return redirect()->route('management.index')->with('create_user', 'Delete Manager Succesful');

    }


    public function role_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'manager'){
            User::find($user->id)->update([
                'role' => 'user',
                'updated_at' =>now(),
            ]);
            return back()->with('create_user',"Role down  Successful Manager to User");
        }
    }

    public function blogger_change(Request $request,$id){
        $user = User::where('id',$id)->first();

        if($user->role == 'blogger'){
            User::find($user->id)->update([
                'role' =>$request->role,
                'updated_at' =>now(),
            ]);
            return back()->with('create_user',"Role down  Successful Manager to User");
        }
    }

    public function user_change(Request $request,$id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'role' =>$request->role,
                'updated_at' =>now(),
            ]);
            return back()->with('create_user',"Role down  Successful Manager to User");
        }
    }
}
