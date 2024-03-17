<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiseaseMedicationModel;
use App\Models\DiseaseModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiseaseController extends Controller
{
    public function index(Request $request){
        $data['diseases'] = DiseaseModel::join('tbl_diseases_medications', 'tbl_diseases_medications.disease_id', '=', 'tbl_diseases.disease_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_diseases_medications.medication_id')
        ->select('tbl_diseases.disease_id', 'tbl_diseases.disease_name', 'tbl_diseases.short_description', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names')) // Select the product name
        ->groupBy('tbl_diseases.disease_id','tbl_diseases.disease_name','tbl_diseases.short_description') // Group by the disease_id
        ->paginate(8)
        ->appends($request->all());
        
        return view('admin.disease.index',compact('data'));
    }
    public function AddDisease(){
        $data['formtype']='add';
        return view('admin.disease.add',compact('data'));
    }
    public function InsertDisease(Request $request){
        $disease_name= $request->disease_name;
        $short_description=$request->short_description;
        $information=$request->disease_information;
        $products=$request->products;
        $count_products=count($request->products);
    
        if($count_products<1){
            return response()->json(['status' => 'error', 'message' => 'No Items added in Invoice']); 
        }

        $disease=new DiseaseModel();
        $disease->disease_name=$disease_name;
        $disease->short_description=$short_description;
        $disease->information=$information;
        if($disease->save()){
            $insert_id=$disease->disease_id;
            foreach($products as $item=>$value){
                $product_entry=$value;
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $disease_details=new DiseaseMedicationModel();
                $disease_details->disease_id=$insert_id;
                $disease_details->medication_id=$product;
                $disease_details->save();
            }
                return response()->json(['status' => 'success', 'message' => 'Disease and details saved successfully']);        
            
        }else{
            return response()->json(['status' => 'error', 'message' => 'Failed to save details']); 
                   }
        
    }
    public function Edit_disease(Request $request, $id){
        $data['formtype']='edit';
        $data['disease'] = DiseaseModel::join('tbl_diseases_medications', 'tbl_diseases_medications.disease_id', '=', 'tbl_diseases.disease_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_diseases_medications.medication_id')
        ->select('tbl_diseases.disease_id', 'tbl_diseases.disease_name', 'tbl_diseases.short_description','tbl_diseases.information', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names')) // Select the product name
        ->groupBy('tbl_diseases.disease_id','tbl_diseases.disease_name','tbl_diseases.short_description','tbl_diseases.information')
        ->where('tbl_diseases_medications.disease_id',$id)
        ->first();
        if ($data['disease']) {
            $data['disease']->product_names = explode(',', $data['disease']->product_names);
        }
        // dd($data['disease']);        
        return view('admin.disease.add',compact('data'));
    }
    public function UpdateDisease(Request $request){
        $disease_name= $request->disease_name;
        $disease_id=$request->disease_id;
        $short_description=$request->short_description;
        $information=$request->disease_information;
    
        if(!$request->products){
            return response()->json(['status' => 'error', 'message' => 'No Products linked to Disease']); 
        }else{
            $products=$request->products;

        }


        $disease=DiseaseModel::find($disease_id);
        $disease->disease_name=$disease_name;
        $disease->short_description=$short_description;
        $disease->information=$information;
        if($disease->save()){
            DiseaseMedicationModel::where('disease_id', $disease_id)->delete();
            $insert_id=$disease_id;
            foreach($products as $item=>$value){
                $product_entry=$value;
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $disease_details=new DiseaseMedicationModel();
                $disease_details->disease_id=$insert_id;
                $disease_details->medication_id=$product;
                $disease_details->save();
            }
                return response()->json(['status' => 'success', 'message' => 'Disease and details updated successfully']);        
            
        }else{
            return response()->json(['status' => 'error', 'message' => 'Failed to update details']); 
        }
        
    }
    public function DeleteDisease(Request $request, $id){
        DiseaseMedicationModel::where('disease_id', $id)->delete();
        $disease=DiseaseModel::find($id);
        if($disease->delete()){
            return redirect('diseases')->with('status', 'Disease Removed Successfully.');

        }else{
            return redirect('diseases')->with('status', 'Disease Removal unsuccessful.');
        }


    }

}
