<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discounts;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){

        $product=Product::select('tbl_products.*', DB::raw('GROUP_CONCAT(tbl_categories.category_name) as category_names'))
            ->join('tbl_categories', function ($join) {
            $join->whereRaw('FIND_IN_SET(tbl_categories.category_id, tbl_products.category) > 0');
            })
            ->groupBy('tbl_products.product_id','tbl_products.product_name','product_description'
            ,'category','unit_price','stock_available','discount_rate','prodpriority','product_image'
            ,'created_at','updated_at','is_deleted')
        ->orderBy('category')->paginate(10);
        return view('admin.product.index',compact('product'));
    }
    public function add(){
        $data['category']= Category::where('is_deleted',0)->get();;
        $data['formtype']="add";

        return view('admin.product.add',compact('data'));
    }
    public function insert(Request $request){
        $cate=$request->input('prodcate');

        $category= new Category;
        $cate=$request->input('prodcate');
        $product_cate='';
        foreach($cate as $item){
            $cateinfo=$category->where('category_name',$item)->first();
            $item_id=$cateinfo->category_id;
            if($product_cate==''){
                $product_cate=$product_cate.$item_id;

            }else{
                $product_cate=$product_cate.','.$item_id;

            }
        }
        $product=new Product();
        if($request->hasFile('prodimage')){
            $file=$request->file('prodimage');
            $ext=$file->getClientOriginalExtension();
            $filename= time().'.'.$ext;
            $filepath='public/assets/uploads/products/'.$filename;
            $newpath=$request->file('prodimage')->storeAs($filepath,$filename);
            $path = Storage::disk('s3')->put($filepath,file_get_contents($file));
            $path = Storage::url($filepath);
            $product->product_image=$path;
        }
        $product->product_name=strtoupper($request->input('prodname')) ;
        $product->product_description=$request->input('proddescr');
        $product->category=$product_cate;
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');
        $product->prodpriority=$request->input('prodpriority');


        if($product->save()){
            return redirect('products')->with('status','Product Added Successfully.');

        }else{
            return redirect()->back()->with('status','Product Failed to add.');

        }
    }
    public function edit($id){
        $data['formtype']="edit";
        $data['category']= Category::all();
        $data['product'] = Product::select('tbl_products.*', 
        DB::raw('GROUP_CONCAT(tbl_categories.category_name) as category_names'))
            ->join('tbl_categories', function ($join) {
            $join->whereRaw('FIND_IN_SET(tbl_categories.category_id, tbl_products.category) > 0');
            })
            ->groupBy('tbl_products.product_id','tbl_products.product_name','product_description','category','unit_price','stock_available','discount_rate','prodpriority','product_image','created_at','updated_at','is_deleted')
            ->find($id);
        $category_names = explode(',', $data['product']->category_names);
        
        for ($i = 0; $i < count($category_names); $i++) {
            $combinedArray[] = [
                'product_name' => $category_names[$i],

            ];
        }

            // Replace product_names and invoice_quantities with the combined array
        $data['product']->category_array = $combinedArray;

        return view('admin.product.add',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([            
            'prodname' => ['required', 'string', 'max:255'],
            'proddescr' => ['required', 'string', 'max:2000'],
            'prodprice' => ['required','min:0','gt:0' ],
            'prodquan' => ['required','min:0','gt:0'],
            'prodpriority' => ['required'],
            'prodcate'=>['exists:App\Models\Category,category_name'],
        ]);
        $category= new Category;
        $cate=$request->input('prodcate');
        $product_cate='';
        foreach($cate as $item){
            $cateinfo=$category->where('category_name',$item)->first();
            $item_id=$cateinfo->category_id;
            if($product_cate==''){
                $product_cate=$product_cate.$item_id;

            }else{
                $product_cate=$product_cate.','.$item_id;

            }
        }
        $product=Product::find($id);
        if($request->hasFile('prodimage')){

            $filepath='public/assets/uploads/products/'.$product->product_image;

            if(Storage::disk('s3')->exists($filepath)){
                Storage::disk('s3')->delete($filepath);
            }
            $file=$request->file('prodimage');
            $ext=$file->getClientOriginalExtension();
            $filename= time().'.'.$ext;
            $filepath='public/assets/uploads/products/'.$filename;
            $newpath=$request->file('prodimage')->storeAs($filepath,$filename);
            $path = Storage::disk('s3')->put($filepath,file_get_contents($file));
            $path = Storage::url($filepath);
            $product->product_image=$path;
        }
        $product->product_name=$request->input('prodname');
        $product->product_description=$request->input('proddescr');
        $product->category=$product_cate;
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');
        $product->prodpriority=$request->input('prodpriority');


        if($product->update()){
            return redirect('products')->with('status','Product Updated Successfully.');

        }else{
            return redirect('products')->with('status','Failed to update product.');


        }
    }
    public function delete(Request $request,$id){
        $product=Product::find($id);
        if($product->product_image){
            $filepath=$product->product_image;
            if(Storage::disk('s3')->exists($filepath)){
                Storage::disk('s3')->delete($filepath);
            }
        }
        $product->is_deleted=1;
        $product->update();
        return redirect()->back()->with('status','Product Deleted Successfully.');
    }
}
