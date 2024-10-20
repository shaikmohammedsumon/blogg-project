<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contract_created(Request $request){
        $request->validate([
            '*' => 'required'
        ]);
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'massege' => $request->massege,
            'subject' => $request->subject,
        ]);
        return back();

    }

    public function contract(){
        $contracts = Contact::get();
        return view('dashborad.contract.index',compact('contracts'));
    }
}
