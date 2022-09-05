<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use PHPUnit\Framework\Constraint\IsEmpty;


class Registration extends Controller
{
    public function landing(){
        return view('Landing.index');
    }
    public function registration(){
        $data['countries']=Countries::all();
        return view('auth/register',compact('data'));
    }
    
    public function login(){
        return view('auth/login');
        
    }
    public function storeuser(Request $request){
        $user=new User();
        $request->validate([            
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'country'=>['required','exists:App\Models\Countries,name'],
            'phone' => ['required', 'max:10','min:10','unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:6','max:12','required_with:password_confirm','same:password_confirm']]);
        $user->firstname=$request->input('firstname');
        $user->surname=$request->input('surname');
        $user->email=$request->input('email');
        $user->telephone=$request->input('phone');
        $user->role_as=2;
        $user->country=$request->input('country');
        $user->password=Hash::make($request->input('password'));
        if($user->save()){
            return redirect('login')->with('status','Account Created Successfully.');
        }else{
            return redirect()->back()->with('status','Account Creation Unsuccessful. Please try again.');
        }

    }
    public function signin(Request $request)
    {
        $request->validate([            
  
            'userlog' => ['required'],
            'password' => ['required','min:6','max:12']]);

        session()->regenerate();
        $user=new User();


        $userlogin = $request->input('userlog');
        $password =$request->input('password');
        $data_email = $user->where('email', $userlogin)->first();
        $data_phone = $user->where('telephone', $userlogin)->first();



        if ($data_email && $data_email['is_deleted']==0) {

            if (Hash::check($password,$data_email['password'])) {

                if($data_email['role_as']==1){
                    $sessionData = [
                        'user_id' => $data_email['user_id'],
                        'email' => $data_email['email'],
                        'firstname'  => $data_email['firstname'],
                        'surname'  => $data_email['surname'],
                        'phone'=> $data_email['telephone'],
                        'role'  => $data_email['role_as'],
                        'logged' => TRUE,
    
                    ];
                    session($sessionData);

                    return redirect('/dashboard')->with('status','Logged In Successfully.');


                }else{
                    $sessionData = [
                        'user_id' => $data_email['user_id'],
                        'email' => $data_email['email'],
                        'firstname'  => $data_email['firstname'],
                        'surname'  => $data_email['surname'],
                        'country'  => $data_email['country'],
                        'phone'  => $data_email['telephone'],
                        'role'  => $data_email['role_as'],
                        'logged' => TRUE,
                        'purchase'=>false
    
                    ];
                    session($sessionData);
                    return redirect('home')->with('status','Logged In Successfully.');
                }
               
            } 
            else {
                return redirect('login')->with('status','Wrong password. Please enter correct password');
            }
        }
        else if (($data_phone && $data_phone['is_deleted']==0)) {
             if ((Hash::check($password,$data_phone['password']))) {

                if($data_phone['role_as']==1){
                    $sessionData = [
                        'user_id' => $data_phone['user_id'],
                        'email' => $data_phone['email'],
                        'firstname'  => $data_phone['firstname'],
                        'surname'  => $data_phone['surname'],
                        'phone'=> $data_phone['telephone'],
                        'role'  => $data_phone['role_as'],
                        'logged' => TRUE,
    
                    ];
                    session($sessionData);

                    return redirect('/dashboard')->with('status','Logged In Successfully.');


                }else{
                    $sessionData = [
                        'user_id' => $data_phone['user_id'],
                        'email' => $data_phone['email'],
                        'firstname'  => $data_phone['firstname'],
                        'surname'  => $data_phone['surname'],
                        'country'  => $data_phone['country'],
                        'phone'  => $data_phone['telephone'],
                        'role'  => $data_phone['role_as'],
                        'logged' => TRUE,
                        'purchase'=>false
    
                    ];
                    session($sessionData);
                    return redirect('home')->with('status','Logged In Successfully.');
                }
               
            } 
            else {
                return redirect('login')->with('status','Wrong password. Please enter correct password');
            }
        }
        else {
            return redirect('login')->with('status','User Does Not Exist. Please Confirm Credentials or Register');
        }
    }
    public function landingpage()
    {
        return view('landingpage');
    }
    public function logout()
    {

        session()->flush();

        return redirect('login');
    }

}
