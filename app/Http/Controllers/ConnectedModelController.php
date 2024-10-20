<?php

namespace App\Http\Controllers;

use App\Models\ConnectedModel;
use Illuminate\Http\Request;

class ConnectedModelController extends Controller
{
    public function index(){
        $connecteds = ConnectedModel::get();
        return view('dashborad.connected.index',compact('connecteds'));
    }

    public function createdd(Request $request){
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'links' => 'required'
        ]);

        ConnectedModel::create([
            'icon' =>$request->icon,
            'name' =>$request->name,
            'links' => $request->links,
            'created_at' => now()
        ]);
        return back()->with('create_connected'," Created Connected Successful");

    }

    public function action($id){
        $connecteds = ConnectedModel::where('id',$id)->first();

        if( $connecteds->status == 'deactive'){

            ConnectedModel::find($connecteds->id)->update([
                'status' => 'active',
                "updated_at" => now(),
            ]);
            return redirect()->route('connected.index')->with('connected_update', 'Active Succesful');
        }else{
            ConnectedModel::find($connecteds->id)->update([
                'status' => 'deactive',
                "updated_at" => now(),
            ]);
            return redirect()->route('connected.index')->with('connected_update', 'Deactive Succesful');
        }

    }

    public function edit($id){
        $connecteds = ConnectedModel::where('id',$id)->first();
        return view('dashborad.connected.edit',compact('connecteds'));
    }

    public function update(Request $request, $id){
        $connecteds = ConnectedModel::where('id',$id)->first();
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'links' => 'required'
        ]);

        ConnectedModel::find($connecteds->id)->update([
            'icon' =>$request->icon,
            'name' => $request->name,
            'links' => $request->links,
            "updated_at" => now(),
        ]);
        return redirect()->route('connected.index')->with('connected_update', 'connected Update Succesful');

    }

    public function delete($id){
        $connecteds = ConnectedModel::where('id',$id)->first();
        ConnectedModel::find($connecteds->id)->delete();
        return redirect()->route('connected.index')->with('connected_delete', 'connected Delete Succesful');

    }

}
