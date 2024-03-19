<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Discounts;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Orders;
use App\Models\Orderdetails;
use Illuminate\Support\Facades\Session;
use App\Models\QueryModel;
use App\Models\Countries;
use App\Models\DiseaseModel;
use App\Models\MessagesModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    public function index(){
        session();
        $data['user_role']=session('role');    
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['topprods']=Product::where('is_deleted',0)->orderBy('prodpriority','DESC')->paginate(3);
        return view('user/homepage', compact('data'));
    }
    public function products(Request $request){
        session();
        $data['cateid']=NULL;
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $data['product_max_price']=Product::max('unit_price');
        $discount=$markerterdiscount->discount_percentage;
        $data['discount']=$discount/100;
        $data['categories']=Category::findMany([3,6,5,25])->where('is_deleted',0);
        $data['categorieslist']=Category::where('is_deleted',0)->orderBy('category_name', 'asc')->get();
        $data['diseases']=DiseaseModel::select('disease_id','disease_name',)->get();
        $data['product_max_price']=Product::max('unit_price');
        $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->orderBy('category')->paginate(8)->appends($request->all());
        return view('user/products',compact('data'));
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
        $data['products']=Product::where('tbl_products.product_name', 'like', '%' .$product . '%')->where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->paginate(8)->appends($request->all());
        return view('user/products',compact('data'));


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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
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
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
    
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
    
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_categories.category_id',$data['cateid'])
    
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
                            ->where('tbl_categories.category_id',$data['cateid'])
                            ->orderBy($orderby,$orderreal)->paginate(8)->appends($request->all());
                        }else{
                            $data['products']=Product::
                            join('tbl_categories','tbl_products.category',"=",'tbl_categories.category_id')
                            ->where('tbl_products.is_deleted',0)
                            ->whereNotNull('tbl_products.discount_rate')
                            ->where('tbl_products.stock_available','>',0)
                            ->where('tbl_products.unit_price','>=', $data['min_price'])
                            ->where('tbl_products.unit_price','<=',$data['max_price'])
                            ->where('tbl_categories.category_id',$data['cateid'])
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
    public function cartpage(){
        $productcart=[];
        if(Session::has('cart')){
            foreach(session('cart') as $item){
                array_push($productcart,$item);
            }
        }
        return view('user/cart',compact('productcart'));
    }
    public function checkout(Request $request){
        $request->validate([            
            "nairobi-location" => ["required_if:regionselected,==,nairobi"],
            'outskirt-location' => ["required_if:regionselected,==,outsidenairobi"],
            'town' => ["required_if:regionselected,==,outsidenairobi"]
        ]);

        $productcart=[];
        if(Session::has('cart')){
            foreach(session('cart') as $item){
                array_push($productcart,$item);
            }
        }

        if($request->input('regionselected')=='nairobi'){
            $item_array=array('town'=>'Nairobi','address'=>$request->input('nairobi-location'));
            Session::push('delivery', $item_array);

        }else{
            $item_array=array('town'=>$request->input('town'),'address'=>$request->input('outskirt-location'));
            Session::push('delivery', $item_array);
        }
        $transaction_code=uniqid('SIEA-',FALSE);
        session(['payment_total' => $request->input('amount')]);

        return view('user/checkout',compact('productcart','transaction_code'));
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
        $data['products']=Product::where('tbl_products.is_deleted',0)->join('tbl_categories','category',"=",'tbl_categories.category_id')->where('tbl_categories.category_id', $id)->paginate(8)->appends($request->all());
        return view('user/products',compact('data'));

    }
    public function viewproduct($id){
        session();
        $data['user_role']=session('role'); 
        $markerterdiscount=Discounts::find(2);
        $discount=$markerterdiscount->discount_percentage;


        $data['discount']=$discount/100;
        $data['product']=Product::find($id);
        return view('user/viewproduct', compact('data'));
    }
    public function addtocart($id){
        session();
        $product=Product::find($id);
        $user_role=session('role');    
        $prodprice=$product->unit_price; 
   
        if($user_role==3){
            $markerterdiscount=Discounts::find(2);
            $discount=$markerterdiscount->discount_percentage;
            $newdiscount=$discount/100; 
            $prodprice=$prodprice-($prodprice*$newdiscount);
        }
        if(Session::has('cart')){
            $item_array_id=array_column(session('cart'),"product_ID");
            if(!in_array($id,$item_array_id)){
                $count=count(session('cart'));
                $item_array=array('product_ID'=>$id,'Quantity'=>1,'stock'=>$product->stock_available,'price'=>$prodprice,'productname'=>$product->product_name,'subtotal'=>$product->$prodprice);
                Session::push('cart', $item_array);
                return redirect()->back()->with('status','Item Has Been Added To Cart.');

            }
            else{
                return redirect()->back()->with('status','Item Is Already In Cart.');
            }
        }else{
            $item_array=array('product_ID'=>$id,'Quantity'=>1,'stock'=>$product->stock_available,'price'=>$prodprice,'productname'=>$product->product_name,'subtotal'=>$prodprice);
            $productdata[0]=$item_array;
            Session::put('cart', $productdata);
            return redirect()->back()->with('status','Item Has Been Added To Cart.');
        }

    }
    public function updatequantity(Request $request){
        $product_quantity=$request->input('productquantity');
        $product_id=$request->input('prodid');
        $prodprice=$request->input('prodprice');
        $prodstock=$request->input('prodstock');
        $items = Session::get('cart', []);


        foreach($items as &$item){
            if($item['product_ID']==$product_id){
                if($item['stock']<$product_quantity){
                    return redirect('cart')->with('status','Quantity Is Greater Than Available Stock. Please Select a Different Value');
                }else{
                    $item['Quantity']=$product_quantity;
                    $item['subtotal']=intval($prodprice)*intval($product_quantity);
                    Session::put('cart', $items);
                    return redirect('cart')->with('status','Quantity has been updated.');
                }
            }
        }
    }
    public function deletefromcart($id){
        foreach(session('cart') as $key=>$value){
            if($value['product_ID']==$id){
                Session::pull('cart.'.$key); 
                return redirect('cart')->with('status','Item Has Been Removed From Cart.');
            }
        }
                    
    }
    public function viewprofile(){
        $order=new Orders();
        $orderdets= new Orderdetails();
        $user_id=session('user_id');
        $data['countries']=Countries::all();
        $data['user']= User::find($user_id);
        $data['orders']=$order->where('orders.user_id',$user_id)->paginate(5);
        $data['orderdets']=$order->where('orders.user_id',$user_id)->join('orderdetails', 'orders.order_id','=','orderdetails.order_id')->join('tbl_products', 'orderdetails.product_id','=','tbl_products.product_id')->join('delivery','orders.order_id','=','delivery.order_id')->orderBy('orders.created_at','DESC')->get();

        return view('user/viewprofile', compact('data'));
    }
    public function viewreceipt($id){
        $order=new Orders();
        $orderdets= new Orderdetails();
        $user_id=session('user_id');
        $data['user']= User::find($user_id);
        $data['order']=Orders::find($id);
        $data['orderdets']=$order->where('orders.order_id',$id)->join('orderdetails', 'orders.order_id','=','orderdetails.order_id')->join('tbl_products', 'orderdetails.product_id','=','tbl_products.product_id')->join('delivery','orders.order_id','=','delivery.order_id')->get();

        return view('user/receipt', compact('data'));
    }

    public function updateuserprofile(Request $request){
        $request->validate([            
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'country'=>['required','exists:App\Models\Countries,name'],
            'phone' => ['required', 'max:10','min:9'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'role'=>['exists:App\Models\Role,role_id'] 
        ]);
        $id=session('user_id');
        $user=User::find($id);
        $user->firstname=$request->input('firstname');
        $user->surname=$request->input('surname');
        $user->email=$request->input('email');
        $user->country=$request->input('country');
        $user->telephone=$request->input('phone');
        if($request->input('password')){
            if($request->input('password')==$request->input('confirmpassword')){
                $user->password=Hash::make($request->input('password'));
            }else{
                return back()->with('status','Passwords do not match.');   
            }
            
        }
        $user->update();
        return redirect('viewprofile')->with('status','Acount Updated Successfully.');
    }

    public function submitquery(Request $request){
        $enquery=new MessagesModel();
        $enquery->user_id=session('user_id');
        $enquery->serviced='pending';
        $enquery->question=$request->input('subquest');
        if($enquery->save()){
            return redirect('home')->with('status','Query Submitted Successfully.');

        }else{
            return redirect('home')->with('status','Query Submission Unsuccessful.');
        }

    }
    public function AutoCompleteProductList(Request $request)
    {
        $search_part=preg_replace('/[^\p{L}\p{N}]/u', '',$request->input('query'));
        $data=Product::where('product_name', 'like', '%'.$search_part. '%')
        ->select('product_name')->take(5)->get();
     
        return response()->json($data);
    }
}
