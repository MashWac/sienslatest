<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discounts;

class DiscountController extends Controller
{
    public function index(){
        $discount=Discounts::where('tbl_discounts.is_deleted',0)->paginate(10);
        return view('admin.discounts.index',compact('discount'));
    }
    public function add(){
        $data['formtype']="add";

        return view('admin.discounts.add',compact('data'));
    }
    public function insert(Request $request){
        $request->validate([            
            'discountcode' => ['required', 'string', 'max:30'],
            'discountpercentage' => ['required', 'min:0','gt:0']
        ]);
        $discount= new Discounts;
        $discount->discount_code=$request->input('discountcode');
        $discount->discount_percentage=$request->input('discountpercentage');

        $discount->save();
        return redirect('discounts')->with('status','Discount Added Successfully.');
    }
    public function edit($id){
        $data['formtype']="edit";
        $data['product']=Discounts::find($id);

        return view('admin.discounts.add',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([            
            'discountcode' => ['required', 'string', 'max:30'],
            'discountpercentage' => ['required', 'min:0','gt:0']
        ]);
        $discount= new Discounts;
        $discount->discount_code=$request->input('discountcode');
        $discount->discount_percentage=$request->input('discountpercentage');
        $discount->update();
        return redirect('discounts')->with('status','Discount Updated Successfully.');
    }
    public function delete(Request $request,$id){
        $discount=Discounts::find($id);
        $discount->is_deleted=1;
        $discount->update();
        return redirect()->back()->with('status','Discount Deleted Successfully.');
    }
}
