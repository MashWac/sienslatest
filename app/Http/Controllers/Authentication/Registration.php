<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Discounts;
use App\Models\Product;
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
            'telephone' => ['required', 'max:10','min:10','unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:6','max:12','required_with:password_confirm','same:password_confirm']]);
        $user->firstname=$request->input('firstname');
        $user->surname=$request->input('surname');
        $user->email=$request->input('email');
        $user->telephone=$request->input('telephone');
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
        if (is_numeric($userlogin)){
            $data_user = $user->where('telephone', $userlogin)->first();
        }else{
            $data_user = $user->where('email', $userlogin)->first();
        }          
        



        if ($data_user && $data_user['is_deleted']==0) {

            if (Hash::check($password,$data_user['password'])) {

                if($data_user['role_as']==1){
                    $sessionData = [
                        'user_id' => $data_user['user_id'],
                        'email' => $data_user['email'],
                        'firstname'  => $data_user['firstname'],
                        'surname'  => $data_user['surname'],
                        'phone'=> $data_user['telephone'],
                        'role'  => $data_user['role_as'],
                        'logged' => TRUE,
    
                    ];
                    session($sessionData);

                    return redirect('/dashboard')->with('status','Logged In Successfully.');


                }else{
                    $sessionData = [
                        'user_id' => $data_user['user_id'],
                        'email' => $data_user['email'],
                        'firstname'  => $data_user['firstname'],
                        'surname'  => $data_user['surname'],
                        'country'  => $data_user['country'],
                        'phone'  => $data_user['telephone'],
                        'role'  => $data_user['role_as'],
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
    public function productspreview(){
        session();
        $data['cateid']=NULL;
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->orderBy('category')->paginate(6);
        return view('productspreview',compact('data'));
    }
    public function searchproducts(Request $request){
        session();
        $data['cateid']=NULL;
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $product=$request->input('searchfield');
        $data['products']=Product::where('tbl_products.product_name', 'like', '%' .$product . '%')->where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->paginate(6);
        return view('productspreview',compact('data'));


    }
    public function filterbysort(Request $request){
        session();
        $str=$request->input('order');
        if($str=='nameasc'||$str=='priceasc'||$str=='dateasc'){
            $orderreal='asc';
            if($str=='nameasc'){
                $orderby='tbl_products.product_name';

            }elseif($str=='priceasc'){
                $orderby='tbl_products.unit_price';
            }else{
                $orderby='tbl_products.created_at';
            }
        }else{
            $orderreal='desc';
            if($str=='namedesc'){
                $orderby='tbl_products.product_name';
            }elseif($str=='pricedesc'){
                $orderby='tbl_products.unit_price';
            }else{
                $orderby='tbl_products.created_at';                
            }
        }
        $data['cateid']=$request->input('cateid');
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        // if($data['cateid']==NULL){
        //     echo 'null';
        //     echo $orderby;
        //     echo $orderreal;

        // }else{
        //     echo $orderby;
        //     echo $orderreal;
        //     echo $data['cateid'];
        // }
        if($data['cateid']==NULL){
            $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->orderBy($orderby,$orderreal)->paginate(6);
        }else{
            $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->where('tbl_categories.category_id',$data['cateid'])->orderBy($orderby,$orderreal)->paginate(6);

        }
        return view('productspreview',compact('data'));
    }
    public function filterprodcategory($id){
        session();
        $data['user_role']=session('role');    
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['cateid']=$id;
        $data['categories']=Category::where('category_id',$id)->get();
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->where('tbl_categories.category_id', $id)->paginate(6);
        return view('productspreview',compact('data'));

    }
    public function viewproduct($id){
        session();
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['product']=Product::find($id);
        return view('viewproductpreview', compact('data'));
    }
}
