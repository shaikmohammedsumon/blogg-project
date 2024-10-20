<?php

namespace App\Http\Controllers;

use App\Models\Abouts;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutsController extends Controller
{
    public function index(){
        return view('dashborad.abouts.index');
    }
    public function created(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            '*' => 'required',
            'image' =>'required'
        ]);

        if($request->hasFile('image')){

            $newName = auth()->user()->id.'-'.$request->title.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/abouts/'.$newName));

               Abouts::create([
                'image' =>$newName,
                'title' =>$request->title,
                'descripion' =>$request->descripion,
                'created_at' =>now(),
               ]);
            return redirect()->route('dashboard.abouts.show')->with('success',"Abouts Create successful");

        }
    }

    public function show(){
        $abouts = Abouts::get();
        return view('dashborad.abouts.show',compact('abouts'));
    }


    // public function action($id){
    //     $abouts = Abouts::where('id',$id)->first();

    //     if( $abouts->status == 'deactive'){
    //         Abouts::find($abouts->id)->update([
    //             'status' => 'active',
    //             "updated_at" => now(),
    //         ]);
    //         return redirect()->route('dashboard.abouts.show')->with('abouts_update', 'Active Succesful');
    //     }else{

    //         Abouts::find($abouts->id)->update([
    //             'status' => 'deactive',
    //             "updated_at" => now(),
    //         ]);
    //         return redirect()->route('dashboard.abouts.show')->with('abouts_update', 'Deactive Succesful');
    //     }

    // }



    public function delete($id){
        $abouts = Abouts::where('id',$id)->first();

        if($abouts->image){
            $oldPath = base_path('public/uploads/abouts/'.$abouts->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }
        Abouts::find($abouts->id)->delete();
        return redirect()->route('dashboard.abouts.show')->with('abouts_delete', 'About Delete Succesful');

    }


    public function action($id){
        // প্রথমে বর্তমান 'Abouts' ইনস্টেন্সটি নিয়ে আসা
        $abouts = Abouts::where('id', $id)->first();

        // যদি ইনস্টেন্সটি 'deactive' হয়, তাহলে
        if ($abouts->status == 'deactive') {
            // সব ইনস্টেন্সকে 'deactive' করা
            Abouts::where('id', '!=', $abouts->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);

            // নির্বাচিত ইনস্টেন্সকে 'active' করা
            $abouts->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard.abouts.show')->with('abouts_update', 'Active Successful');
        } else {
            // যদি ইনস্টেন্সটি 'active' হয়, তাহলে তাকে 'deactive' করা
            $abouts->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard.abouts.show')->with('abouts_update', 'Deactive Successful');
        }
    }


}
