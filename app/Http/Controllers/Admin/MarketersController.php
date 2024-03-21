<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceDetailsModel;
use App\Models\InvoiceModel;
use App\Models\Product;
use App\Models\ReceiptDetailsModel;
use App\Models\ReceiptModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MarketersController extends Controller
{
    public function Index(Request $request){
        $data['marketers'] = User::leftJoin('tbl_invoice', 'tbl_invoice.promoter_id', '=', 'users.user_id')
        ->leftJoin('tbl_receipts', 'tbl_receipts.promoter_id', '=', 'users.user_id')
        ->leftJoin('tbl_invoice_details', 'tbl_invoice_details.invoice_number', '=', 'tbl_invoice.invoice_id')
        ->leftJoin('tbl_receipts_details', 'tbl_receipts_details.receipt_number', '=', 'tbl_receipts.receipt_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_invoice_details.product_id')
        ->join('tbl_products AS receipt_products', 'receipt_products.product_id', '=', 'tbl_receipts_details.product_id')
        ->select('users.user_id', 'users.firstname', 'users.surname', 'users.email', 'users.telephone', 
                  DB::raw('(SELECT SUM(tbl_products.unit_price * tbl_invoice_details.quantity) FROM tbl_invoice_details JOIN tbl_products ON tbl_products.product_id = tbl_invoice_details.product_id WHERE tbl_invoice_details.invoice_number = tbl_invoice.invoice_id) AS invoice_total_value'),
                  DB::raw('(SELECT SUM(receipt_products.unit_price * tbl_receipts_details.quantity) FROM tbl_receipts_details JOIN tbl_products AS receipt_products ON receipt_products.product_id = tbl_receipts_details.product_id WHERE tbl_receipts_details.receipt_number = tbl_receipts.receipt_id) AS receipt_total_value'))
        ->groupBy('users.user_id', 'users.firstname', 'users.surname', 'users.email', 'users.telephone','tbl_invoice.invoice_id','tbl_receipts.receipt_id')
        ->paginate(8)
        ->appends($request->all());
        
        return view('admin.marketers.index',compact('data'));
    }
    public function AddInvoices(){
        $data['formtype']='add';
        return view('admin.marketers.add_invoice',compact('data'));
    }
    public function InsertInvoice(Request $request){
        $invoice_number= $request->invoice_number;
        $promoter=$request->promoters;
        $invoice_date=$request->invoicing_date;
        $products=$request->products;
        $quantities=$request->quantities;
        $count_products=count($request->products);
        $count_quantities=count($request->quantities);

        if($count_products==0|| $count_quantities==0){
            return response()->json(['status' => 'error', 'message' => 'No Items added in Invoice']); 
        }
        if ($count_products!=$count_quantities){
            return response()->json(['status' => 'error', 'message' => 'One or more of the product quantities do not match']);
        }

        $invoice=new InvoiceModel();
        $invoice->invoice_number=$invoice_number;
        $invoice->promoter_id=$promoter;
        $invoice->invoice_date=date($invoice_date);
        if($invoice->save()){
            $insert_id=$invoice->invoice_id;
            for($i = 0; $i < $count_products; $i++){
                $product_entry=$products[$i];
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $quantity_entry=$quantities[$i];
                $invoice_details=new InvoiceDetailsModel();
                $invoice_details->invoice_number=$insert_id;
                $invoice_details->product_id=$product;
                $invoice_details->quantity=$quantity_entry;
                $invoice_details->save();

            }
            return response()->json(['status' => 'success', 'message' => 'Invoice and details saved successfully']);           



        }  else{
            return response()->json(['status' => 'error', 'message' => 'Failed to save invoice details']);           
        }
      
    }
    public function EditInvoice(){
        $data['formtype']='edit';
        return view('admin.marketers.add_invoice',compact('data'));
    }

 
    public function AddReceipt(){
        $data['formtype']='add';
        return view('admin.marketers.add_receipt',compact('data'));

    }
    public function InsertReceipt(Request $request){
        $receipt_number= $request->receipt_number;
        $promoter=$request->promoters;
        $receipt_date=$request->receipting_date;
        $products=$request->products;
        $quantities=$request->quantities;
        if(!$request->products){
            return response()->json(['status' => 'error', 'message' => 'No Products linked to Disease']); 
        }else{
            $products=$request->products;

        }
    
        $receipt=new ReceiptModel();
        $receipt->receipt_number=$receipt_number;
        $receipt->promoter_id=$promoter;
        $receipt->receipt_date=date($receipt_date);
        $count_products=count($products);
        if($receipt->save()){
            $insert_id=$receipt->receipt_id;
            for($i = 0; $i < $count_products; $i++){
                $product_entry=$products[$i];
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $quantity_entry=$quantities[$i];
                $receipt_details=new ReceiptDetailsModel();
                $receipt_details->receipt_number=$insert_id;
                $receipt_details->product_id=$product;
                $receipt_details->quantity=$quantity_entry;
                $receipt_details->save();

            }
            return response()->json(['status' => 'success', 'message' => 'Receipt and details saved successfully']);           

    
        } 
        else{
            return response()->json(['status' => 'error', 'message' => 'Failed to save receipt details']);            
        }


    }
    public function DeleteReceipt(Request $request,$id){
        ReceiptDetailsModel::where('receipt_number', $id)->delete();
        $receipt=ReceiptModel::find($id);
        if($receipt->delete()){
            return redirect('view_receipts')->with('status', 'Receipt Removed Successfully.');

        }else{
            return redirect('view_receipts')->with('status', 'Receipt Removal unsuccessful.');
        }


    }
    public function AutoCompletePromoter(Request $request)
    {
        $search_part=preg_replace('/[^\p{L}\p{N}]/u', '',$request->input('query'));
        $data=User::where('role_as',3)
        ->where('firstname', 'like', $search_part. '%')
        ->orwhere('surname','like', $search_part. '%')
        ->orwhere('email','like', $search_part. '%')
        ->orwhere('telephone','like', $search_part. '%')
        ->select('firstname','surname','user_id')
        ->take(5)->get();
     
        return response()->json($data);
    }
    public function GetPromoter(Request $request)
    {
        $search_part=preg_replace('/[^\p{L}\p{N}]/u', '',$request->input('query'));
        $data=User::find($search_part);
     
        return response()->json($data);
    }
    public function AutoCompleteProductList(Request $request)
    {
        $search_part=preg_replace('/[^\p{L}\p{N}]/u', '',$request->input('query'));
        $data=Product::where('product_name', 'like', '%'.$search_part. '%')
        ->select('product_name')->take(5)->get();
     
        return response()->json($data);
    }
    public function ViewReceipts(Request $request){
        $data['receipts'] = ReceiptModel::join('tbl_receipts_details', 'tbl_receipts_details.receipt_number', '=', 'tbl_receipts.receipt_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_receipts_details.product_id')
        ->join('users', 'users.user_id', '=', 'tbl_receipts.promoter_id')
        ->select('tbl_receipts.receipt_id', 'tbl_receipts.receipt_number', 'tbl_receipts.receipt_date','users.firstname','users.surname','tbl_receipts.promoter_id', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names'),DB::raw('GROUP_CONCAT(tbl_receipts_details.quantity) as invoice_quantities')) // Select the product name
        ->groupBy('tbl_receipts.receipt_id', 'tbl_receipts.receipt_number', 'tbl_receipts.receipt_date','users.firstname','users.surname','tbl_receipts.promoter_id') // Group by the disease_id
        ->paginate(8)
        ->appends($request->all());
        $combinedArray = [];
        foreach ($data['receipts'] as $receipt) {
            // Convert product_names and invoice_quantities strings to arrays
            $productNames = explode(',', $receipt->product_names);
            $invoiceQuantities = explode(',', $receipt->invoice_quantities);
            
            // Combine product names and invoice quantities into a single array
            for ($i = 0; $i < count($productNames); $i++) {
                $combinedArray[] = [
                    'product_name' => $productNames[$i],
                    'invoice_quantity' => $invoiceQuantities[$i]
                ];
            }

            // Replace product_names and invoice_quantities with the combined array
            $receipt->combined_array = $combinedArray;
        }
        return view('admin.marketers.view_receipts',compact('data'));

    }
    public function EditReceipts(Request $request,$id){
        $data['formtype']='edit';
        $data['receipt'] = ReceiptModel::join('tbl_receipts_details', 'tbl_receipts_details.receipt_number', '=', 'tbl_receipts.receipt_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_receipts_details.product_id')
        ->join('users', 'users.user_id', '=', 'tbl_receipts.promoter_id')
        ->select('tbl_receipts.receipt_id', 'tbl_receipts.receipt_number', 'tbl_receipts.receipt_date','users.firstname','users.surname','tbl_receipts.promoter_id', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names'),DB::raw('GROUP_CONCAT(tbl_receipts_details.quantity) as invoice_quantities')) // Select the product name
        ->groupBy('tbl_receipts.receipt_id', 'tbl_receipts.receipt_number', 'tbl_receipts.receipt_date','users.firstname','users.surname','tbl_receipts.promoter_id') // Group by the disease_id
        ->where('tbl_receipts.receipt_id',$id)  
        ->first()
        ;
        $productNames = explode(',', $data['receipt']->product_names);
        $invoiceQuantities = explode(',', $data['receipt']->invoice_quantities);
        
        for ($i = 0; $i < count($productNames); $i++) {
            $combinedArray[] = [
                'product_name' => $productNames[$i],
                'receipt_quantity' => $invoiceQuantities[$i]
            ];
        }

            // Replace product_names and invoice_quantities with the combined array
        $data['receipt']->combined_array = $combinedArray;
        // dd($data['receipt']);
        return view('admin.marketers.add_receipt',compact('data'));
    }
    public function UpdateReceipt(Request $request){
        $receipt_number= $request->receipt_number;
        $receipt_id=$request->receipt_id;
        $promoter=$request->promoters;
        $receipt_date=$request->receipting_date;
        $products=$request->products;
        $quantities=$request->quantities;

        if(!$request->products){
            return response()->json(['status' => 'error', 'message' => 'No Products linked to Disease']); 
        }else{
            $products=$request->products;

        }
        $receipt=ReceiptModel::where('receipt_id',$receipt_id)->first();

        $receipt->receipt_number=$receipt_number;
        $receipt->promoter_id=$promoter;
        $receipt->receipt_date=date($receipt_date);
        $count_products=count($products);
        if($receipt->save()){
            ReceiptDetailsModel::where('receipt_number', $receipt_id)->delete();
            $insert_id=$receipt_id;
            for($i = 0; $i < $count_products; $i++){
                $product_entry=$products[$i];
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $quantity_entry=$quantities[$i];
                $receipt_details=new ReceiptDetailsModel();
                $receipt_details->receipt_number=$insert_id;
                $receipt_details->product_id=$product;
                $receipt_details->quantity=$quantity_entry;
                $receipt_details->save();

            }
            return response()->json(['status' => 'success', 'message' => 'Receipt and details updated successfully']);           

    
        } 
        else{
            return response()->json(['status' => 'error', 'message' => 'Failed to update receipt details']);            
        }

    }

    public function ViewInvoices(Request $request){
        $data['invoices'] = InvoiceModel::join('tbl_invoice_details', 'tbl_invoice_details.invoice_number', '=', 'tbl_invoice.invoice_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_invoice_details.product_id')
        ->join('users', 'users.user_id', '=', 'tbl_invoice.promoter_id')
        ->select('tbl_invoice.invoice_id', 'tbl_invoice.invoice_number', 'tbl_invoice.invoice_date','users.firstname','users.surname','tbl_invoice.promoter_id', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names'),DB::raw('GROUP_CONCAT(tbl_invoice_details.quantity) as invoice_quantities')) // Select the product name
        ->groupBy('tbl_invoice.invoice_id', 'tbl_invoice.invoice_number', 'tbl_invoice.invoice_date','users.firstname','users.surname','tbl_invoice.promoter_id') // Group by the disease_id
        ->paginate(8)
        ->appends($request->all());
        foreach ($data['invoices'] as $receipt) {
            // Convert product_names and invoice_quantities strings to arrays
            $productNames = explode(',', $receipt->product_names);
            $invoiceQuantities = explode(',', $receipt->invoice_quantities);
            
            // Combine product names and invoice quantities into a single array
            for ($i = 0; $i < count($productNames); $i++) {
                $combinedArray[] = [
                    'product_name' => $productNames[$i],
                    'invoice_quantity' => $invoiceQuantities[$i]
                ];
            }

            // Replace product_names and invoice_quantities with the combined array
            $receipt->combined_array = $combinedArray;
        }
        return view('admin.marketers.view_invoices',compact('data'));
    }
    public function EditInvoices(Request $request,$id){
        $data['formtype']='edit';
        $data['invoice'] = InvoiceModel::join('tbl_invoice_details', 'tbl_invoice_details.invoice_number', '=', 'tbl_invoice.invoice_id')
        ->join('tbl_products', 'tbl_products.product_id', '=', 'tbl_invoice_details.product_id')
        ->join('users', 'users.user_id', '=', 'tbl_invoice.promoter_id')
        ->select('tbl_invoice.invoice_id', 'tbl_invoice.invoice_number', 'tbl_invoice.invoice_date','users.firstname','users.surname','tbl_invoice.promoter_id', DB::raw('GROUP_CONCAT(tbl_products.product_name) as product_names'),DB::raw('GROUP_CONCAT(tbl_invoice_details.quantity) as invoice_quantities')) // Select the product name
        ->groupBy('tbl_invoice.invoice_id', 'tbl_invoice.invoice_number', 'tbl_invoice.invoice_date','users.firstname','users.surname','tbl_invoice.promoter_id') // Group by the disease_id
        ->where('tbl_invoice.invoice_id',$id)  
        ->first();

        
        $productNames = explode(',', $data['invoice']->product_names);
        $invoiceQuantities = explode(',', $data['invoice']->invoice_quantities);
        
        for ($i = 0; $i < count($productNames); $i++) {
            $combinedArray[] = [
                'product_name' => $productNames[$i],
                'invoice_quantity' => $invoiceQuantities[$i]
            ];
        }

            // Replace product_names and invoice_quantities with the combined array
        $data['invoice']->combined_array = $combinedArray;
        return view('admin.marketers.add_invoice',compact('data'));


    }
    public function UpdateInvoice(Request $request){
        $invoice_number= $request->invoice_number;
        $invoice_id=$request->invoice_id;
        $promoter=$request->promoters;
        $invoice_date=$request->invoicing_date;
        $products=$request->products;
        $quantities=$request->quantities;


        if(!$request->products){
            return response()->json(['status' => 'error', 'message' => 'No Products linked to Disease']); 
        }else{
            $products=$request->products;

        }

        $count_products=count($products);

        $invoice=InvoiceModel::where('invoice_id',$invoice_id)->first();
        $invoice->invoice_number=$invoice_number;
        $invoice->promoter_id=$promoter;
        $invoice->invoice_date=date($invoice_date);
        if($invoice->update()){
            InvoiceDetailsModel::where('invoice_number', $invoice_id)->delete();
            $insert_id=$invoice_id;
            for($i = 0; $i < $count_products; $i++){
                $product_entry=$products[$i];
                $product=Product::where("product_name",$product_entry)->first();
                $product=$product->product_id;
                $quantity_entry=$quantities[$i];
                $invoice_details=new InvoiceDetailsModel();
                $invoice_details->invoice_number=$insert_id;
                $invoice_details->product_id=$product;
                $invoice_details->quantity=$quantity_entry;
                $invoice_details->save();

            }
            return response()->json(['status' => 'success', 'message' => 'Invoice and details saved successfully']);           



        }  else{
            return response()->json(['status' => 'error', 'message' => 'Failed to save invoice details']);           
        }
    }
    public function DeleteInvoice(Request $request, $id){
        InvoiceDetailsModel::where('invoice_number', $id)->delete();
        $invoice=InvoiceModel::find($id);
        if($invoice->delete()){
            return redirect('view_invoices')->with('status', 'Invoice Removed Successfully.');

        }else{
            return redirect('view_invoices')->with('status', 'Invoice Removal unsuccessful.');
        }


    }



}
