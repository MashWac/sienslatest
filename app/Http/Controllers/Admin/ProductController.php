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
            'prodcate'=>['exists:App\Models\Category,category_id'],
            'prodimage'=>['required','image']
        ]);
        $category= new Category;
        $product=new Product();
        if($request->hasFile('prodimage')){
            $file=$request->file('prodimage');
            $ext=$file->getClientOriginalExtension();
            $filename= time().'.'.$ext;
            $filepath='public/assets/uploads/products/';
            $newpath=$request->file('prodimage')->storeAs($filepath,$filename);
            $file->move('assets/uploads/products/',$filename);
            $filePath = 'images/' . $filename;
            Storage::put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->put(file_get_contents($filename));
            $path = Storage::disk('s3')->url($path);

            $product->product_image=$path;
        }
        $product->product_name=$request->input('prodname');
        $product->product_description=$request->input('proddescr');
        $product->category=$request->input('prodcate');
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');

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
            'prodcate'=>['exists:App\Models\Category,category_id'],
        ]);
        $product=Product::find($id);
        if($request->hasFile('prodimage')){
            $path='assets/uploads/products/'.$product->product_image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file=$request->file('prodimage');
            $ext=$file->getClientOriginalExtension();
            $filename= time().'.'.$ext;
            $filepath='public/assets/uploads/products/';
            $newpath=$request->file('prodimage')->storeAs($filepath,$filename);
            $file->move('assets/uploads/products/',$filename);
            $path = Storage::disk('s3')->put('images', $file);
            $path = Storage::disk('s3')->url($path);
            $product->product_image=$path;
        }
        $product->product_name=$request->input('prodname');
        $product->product_description=$request->input('proddescr');
        $product->category=$request->input('prodcate');
        $product->unit_price=$request->input('prodprice');
        $product->stock_available=$request->input('prodquan');

        $product->update();
        return redirect('products')->with('status','Product Updated Successfully.');
    }
    public function delete(Request $request,$id){
        $product=Product::find($id);
        if($product->prodimage){
            $path='assets/uploads/products/'.$product->product_image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $product->delete();
        return redirect()->back()->with('status','Product Deleted Successfully.');
    }
}
