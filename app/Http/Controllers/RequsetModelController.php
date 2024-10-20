<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequsetModel;
use Illuminate\Http\Request;


class RequsetModelController extends Controller
{


    public function request_show(){
        $requests = RequsetModel::latest()->get();
        return view('dashborad.requset.index',compact('requests'));
    }


    public function request_send(Request $request, $id){
        RequsetModel::create([
            'user_id' => $id,
            'feedback' => $request->feedback,
            'created_at' => now(),
        ]);
        return back();
    }


    public function accept($id){
        $request = RequsetModel::where('id',$id)->first();

        User::find( $request->user_id)->update([
            'role' => 'blogger',
            'updated_id' => now(),
        ]);

        RequsetModel::find($id)->delete();
        return back();

    }

    public function cancel($id){
        
        RequsetModel::find($id)->delete();
        return back();

    }

    



}
