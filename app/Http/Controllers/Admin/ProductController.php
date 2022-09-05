<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $product=Product::all();
        return view('admin.product.index',compact('product'));
    }
    public function add(){
        $data['category']= Category::all();
        $data['formtype']="add";

        return view('admin.product.add',compact('data'));
    }
    public function insert(Request $request){
        $request->validate([            
            'prodname' => ['required', 'string', 'max:255'],
            'proddescr' => ['required', 'string', 'max:255'],
            'prodprice' => ['required','min:0','gt:0' ],
            'prodquan' => ['required','min:0','gt:0'],
            'prodpriority' => ['required'],
            'prodcate'=>['exists:App\Models\Category,category_name'],
            'prodimage'=>['required','image']

        ]);
        $category= new Category;
        $cate=$request->input('prodcate');
        $cateinfo=$category->where('category_name',$cate);
        $cateid=$cateinfo->category_id;
        $product=new Product();
        if($request->hasFile('prodimage')){
            $file=$request->file('prodimage');
            $ext=$file->getClientOriginalExtension();
            $filename= time().'.'.$ext;
            $filepath='public/assets/uploads/products/'.$filename;
            $newpath=$request->file('prodimage')->storeAs($filepath,$filename);
            $path = Storage::disk('s3')->put($filepath,file_get_contents($file));
            $path = Storage::disk('s3')->url($filepath);
            $product->product_image=$path;
        }
        $product->product_name=$request->input('prodname');
        $product->product_description=$request->input('proddescr');
        $product->category=$cateid;
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');
        $product->prodpriority=$request->input('prodpriority');


        $product->save();
        return redirect('products')->with('status','Product Added Successfully.');
    }
    public function edit($id){
        $data['formtype']="edit";
        $data['category']= Category::all();
        $data['product']=Product::find($id);

        return view('admin.product.add',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([            
            'prodname' => ['required', 'string', 'max:255'],
            'proddescr' => ['required', 'string', 'max:255'],
            'prodprice' => ['required','min:0','gt:0' ],
            'prodquan' => ['required','min:0','gt:0'],
            'prodpriority' => ['required'],
            'prodcate'=>['exists:App\Models\Category,category_id'],
        ]);
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
            $path = Storage::disk('s3')->url($filepath);
            $product->product_image=$path;
        }
        $product->product_name=$request->input('prodname');
        $product->product_description=$request->input('proddescr');
        $product->category=$request->input('prodcate');
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');
        $product->prodpriority=$request->input('prodpriority');


        $product->update();
        return redirect('products')->with('status','Product Updated Successfully.');
    }
    public function delete(Request $request,$id){
        $product=Product::find($id);
        if($product->product_image){
            $filepath=$product->product_image;
            if(Storage::disk('s3')->exists($filepath)){
                Storage::disk('s3')->delete($filepath);
            }
        }
        $product->delete();
        return redirect()->back()->with('status','Product Deleted Successfully.');
    }
}
