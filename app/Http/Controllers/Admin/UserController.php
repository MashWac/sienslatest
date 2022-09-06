<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Orders;

class UserController extends Controller
{
    public function index(){
        $users=new User();
        $data['users']=$users->where('users.is_deleted',0)->join('tbl_roles','users.role_as','=','tbl_roles.role_id')->paginate(12);
        return view('admin.users.index',compact('data'));
    }
    public function add(){
        $data['role']= Role::all();
        $data['formtype']="add";
        return view('admin.users.add',compact('data'));
    }
    public function insert(Request $request){
        $user=new User();
        $request->validate([            
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:10','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'=>['exists:App\Models\Role,role_id'] 
        ]);

        $user->firstname=$request->input('firstname');
        $user->surname=$request->input('surname');
        $user->email=$request->input('email');
        $user->role_as=$request->input('role');
        $user->telephone=$request->input('phone');
        $user->country='KENYA';
        $user->password=Hash::make('user1234');

        $user->save();
        return redirect('users')->with('status','User Added Successfully.');
    }
    public function edit($id){
        $data['formtype']="edit";
        $data['role']= Role::all();
        $data['user']=User::find($id);

        return view('admin.users.add',compact('data'));
    }
    public function viewuser($id){
        $data['user']=User::find($id);
        $order= new Orders();
        $data['orders']=$order->where('orders.user_id',$id)->join('users','orders.user_id','=','users.user_id')->join('pesapal_payments','orders.payment_id','=','pesapal_payments.id')->join('delivery','orders.order_id','=','delivery.order_id')->paginate(10);

        return view('admin.users.viewuser',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([            
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:10','min:9'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'role'=>['exists:App\Models\Role,role_id'] 
        ]);
        $user=User::find($id);
        $user->firstname=$request->input('firstname');
        $user->surname=$request->input('surname');
        $user->email=$request->input('email');
        $user->role_as=$request->input('role');

        $user->update();
        return redirect('users')->with('status','User Updated Successfully.');
    }
    public function delete(Request $request,$id){
        $user=User::find($id);
        $user->is_deleted=1;
        $user->update();
        return redirect('users')->with('status','User Deleted Successfully.');
    }
    
}
