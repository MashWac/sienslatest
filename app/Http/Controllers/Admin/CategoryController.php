<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        $category= Category::where('is_deleted',0)->paginate(5);
        return view('admin.category.index',compact('category'));
    }
    public function add(){
        $data['formtype']="add";
        return view('admin.category.add',compact('data'));
    }
    public function insert(Request $request){
        $request->validate([            
            'catename' => ['required', 'string', 'max:255'],
        ]);
        $category= new Category;
        $category->category_name=$request->input('catename');
        $category->popularity=0;

        $category->save();
        return redirect('categories')->with('status','Category Added Successfully.');
    }
    public function edit($id){
        $data['formtype']="edit";
        $data['category']= Category::find($id);

        return view('admin.category.add',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([            
            'catename' => ['required', 'string', 'max:255'],
        ]);
        $category= Category::find($id);
        $category->category_name=$request->input('catename');
        $category->update();
        return redirect('categories')->with('status','Category Updated Successfully.');
    }
    public function delete(Request $request,$id){
        $category=Category::find($id);
        $products=Product::where('category', $id)->get();
        foreach($products as $item){
            $item->is_deleted=1;
            $item->update();
        }
        $category->is_deleted=1;
        $category->update();
        return redirect('categories')->with('status','Category Deleted Successfully.');
    }
    public function view(Request $request,$id){
        $products=Product::where('category',$id)->select('tbl_products.*', DB::raw('GROUP_CONCAT(tbl_categories.category_name) as category_names'))
        ->join('tbl_categories', function ($join) {
        $join->whereRaw('FIND_IN_SET(tbl_categories.category_id, tbl_products.category) > 0');
        })
        ->groupBy('tbl_products.product_id','tbl_products.product_name','product_description'
        ,'category','unit_price','stock_available','discount_rate','prodpriority','product_image'
        ,'created_at','updated_at','is_deleted')
        ->orderBy('category')->paginate(10);
        return view('admin.category.view',compact('products'));
    }
}
