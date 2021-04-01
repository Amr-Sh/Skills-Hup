<?php

namespace App\Http\Controllers\web;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContactController extends Controller
{
    public function index(){

        $data['sett']=Setting::select('email','phone')->first();
        return view('web.contact.index')->with($data);
    }

    public function  send(Request $request){

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'subject'=>'nullable|string|max:255',
            'message'=>'required|string|max:5000|min:5',

        ]);

        Message::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'subject'=>$request->subject,
          'body'=>$request->message,
        ]);
        $data=['message'=>'your message sent successfully',];

        return response()->json($data);
    }
  }

