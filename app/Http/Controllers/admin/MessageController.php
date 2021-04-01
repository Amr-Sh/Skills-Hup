<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\MessageResponseMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index(){
        $data['messages']= Message::orderBy('id','DESC')->paginate(10);
       // $data['cats']= Cat::select('id','name')->get();
        return view('admin.messages.index')->with($data);
    }
    public function show(Message $message){
        $data['message']= $message;

        return view('admin.messages.show')->with($data);
    }
    public function responseMail( Message $message , Request $request){

        $request->validate([
            'title'=>'required|string|max:255',
            'body'=>'required|string'
        ]);
         $recieverMail= $message->email;
         $recieverName= $message->name;
         Mail::to($recieverMail)->send(new MessageResponseMail($recieverName,$request->title,$request->body));
         return redirect(url('dashboard/messages'));
    }
}
