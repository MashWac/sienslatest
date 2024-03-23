<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Discounts;
use App\Models\DiseaseModel;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    public function productspreview(Request $request){
        session();
        $data['cateid']=NULL;
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['product_max_price']=Product::max('unit_price');
        $data['products']=Product::
        select('tbl_products.*', DB::raw('GROUP_CONCAT(tbl_categories.category_name) as category_names'))
        ->join('tbl_categories', function ($join) {
        $join->whereRaw('FIND_IN_SET(tbl_categories.category_id, tbl_products.category) > 0');
        })
        ->where('tbl_products.is_deleted',0)->
        orderBy('tbl_products.category')
        ->groupBy('tbl_products.product_id','tbl_products.product_name','product_description'
        ,'category','unit_price','stock_available','discount_rate','prodpriority','product_image'
        ,'created_at','updated_at','is_deleted')
        ->paginate(8)->appends($request->all());
        $data['diseases']=DiseaseModel::select('disease_id','disease_name',)->get();
        return view('productspreview',compact('data'));
    }
    public function filterbysort(Request $request){
        $str=$request->input('product_order');

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
        $data['cateid']=$request->input('product_category');
        if($data['cateid']!='all'){
            $category=Category::where('category_name',$data['cateid'])->first();
            $data['cateid']=$category->category_id;

        }
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['search_product']=$request->input('search_product');

        $data['ailment']=$request->input('ailment');
        $data['min_price']=intval($request->input('minimum_price'));
        $data['max_price']=intval($request->input('max_price'));
        $product_max_price=Product::max('unit_price');
        $data['in_stock']=$request->input("in_stock");
        $data['discounted']=$request->input('discounted'); 
        if($data["search_product"]!=null){
            if($data['cateid']=='all'){
                if($data['ailment']!="all"){
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
    
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->whereNotNull('tbl_products.discount_rate')
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());          
                          }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
    
                }else{
    
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                   
                         }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                   
                         }else{
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
                }
            }
            else{
                if($data['ailment']!="all"){
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                    
                        }
                    }else{
                        if($data['discounted']!='discounted'){
    
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                    
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all()); 
                        }
                    }
    
                }else{
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
    
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.product_name','like','%'.$data["search_product"].'%')

                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
                }
            }

        }else{
            if($data['cateid']=='all'){
                if($data['ailment']!="all"){
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
    
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->whereNotNull('tbl_products.discount_rate')
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());          
                          }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
    
                }else{
    
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                   
                         }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                   
                         }else{
                            $data['products']=Product::
                            where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
                }
            }
            else{
                if($data['ailment']!="all"){
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                    
                        }
                    }else{
                        if($data['discounted']!='discounted'){
    
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());                    
                        }else{
                            $data['products']=Product::
                            join('tbl_diseases_medications','tbl_products.product_id','=','tbl_diseases_medications.medication_id')
                            ->join('tbl_diseases','tbl_diseases_medications.disease_id','=','tbl_diseases.disease_id')
                            ->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
                            ->whereNotNull('tbl_products.discount_rate')
    
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_diseases.disease_name',$data['ailment'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all()); 
                        }
                    }
    
                }else{
                    if($data['in_stock']!='in_stock'){
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
    
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
    
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
    
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }else{
                        if($data['discounted']!='discounted'){
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->where('tbl_products.stock_available','>',0)
    
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                             ->whereraw("find_in_set(?, tbl_products.category)", [$data['cateid']])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }
                    }
                }
            }

        }

        if ($data['products']->isEmpty()){ 
            return response()->json(['error' => 'No products'],404);
        }else{
            return view('user.productsearch_view', compact('data'))->render();
        }


    }
    public function filterprodcategory(Request $request,$id){
        session();
        $data['user_role']=session('role');    
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['cateid']=$id;
        $data['categories']=Category::where('category_id',$id)->get();
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')->where('tbl_categories.category_id', $id)->paginate(8)->appends($request->all());
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
    public function AutoCompleteProductList(Request $request)
    {
        $search_part=preg_replace('/[^\p{L}\p{N}]/u', '',$request->input('query'));
        $data=Product::where('product_name', 'like', '%'.$search_part. '%')
        ->select('product_name')->take(5)->get();
     
        return response()->json($data);
    }

}
