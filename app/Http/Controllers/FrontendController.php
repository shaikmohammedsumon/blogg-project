<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FrontendController extends Controller
{
    //


    public function profile(){
        return view('dashborad.profile.index');
    }


    public function name_update(Request $request){
        $oldname = Auth::user()->name;
        $request->validate([
            'name' => 'required',
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'update_at' => now(),
        ]);
        return back()->with('profile_update',value: "Name Update Successful $oldname to $request->name");
    }


    public function email_update(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        User::find(auth()->user()->id)->update([
            'email' => $request->email,
            'update_at' =>now(),
        ]);
        return back()->with('profile_update',value: "Email Update Successful");

    }

    public function passeord_update(Request $request){
        $request->validate([
            'current_password' => 'required|min:8',
            'password'=>'required|min:8|confirmed',
        ]);

        if(Hash::check($request->current_password,Auth::user()->password)){
            User::find(auth()->user()->id)->update([
                'password' => $request->password,
                'update_at' => now(),
            ]);
            return back()->with('profile_update',"password Update Successful");
        }else{
            return back()->withErrors(['error_pass' => "Old Password dous't match"])->withInput();
        }

    }


    public function image_update(Request $request){
       $request->validate([
            'image' =>'required|image',
       ]);
        $manager = new ImageManager(new Driver());
        if($request->hasFile('image')){

            if(Auth::user()->image){
                $oldPath = base_path('public/uploads/profile/'.Auth::user()->image);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            $newName = Auth::user()->id.'-'.now()->format('M d,Y').'-'.rand(0,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read( $request->file('image'));
            $image->toPng()->save(base_path('public/uploads/profile/'.$newName));

            User::find(auth()->user()->id)->update([
                'image' => $newName,
                'update_at' => now(),
            ]);
        return back()->with('profile_update', "image Update Successful");

        }

    }
}
