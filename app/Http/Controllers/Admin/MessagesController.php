<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessagesModel;
use App\Models\QueryModel;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $messages=new MessagesModel();
        $data['newmessages']=MessagesModel::where('tbl_messages.serviced','pending')->join('users','users.user_id','=','tbl_messages.user_id')->select('tbl_messages.message_id','tbl_messages.question','tbl_messages.created_at','tbl_messages.serviced','users.firstname','users.surname','users.email','users.telephone')->paginate(4);
        $data['oldmessages']=MessagesModel::where('tbl_messages.serviced','serviced')->join('users','users.user_id','=','tbl_messages.user_id')->paginate(4);
        return view('admin.messages.index', compact('data'));
    }
    public function servicemessage(Request $request){
        $id=$request->input('messageid');
        $message=MessagesModel::where('message_id', $id)->first();
        $message->serviced='serviced';
        if($message->update()){
            return redirect()->to('messages')->with('status','Message Serviced Successfully');
        }
        
    }
}
