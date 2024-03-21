<?php

use App\Http\Controllers\Admin\DiscountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\MarketersController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\User\FrontController;
use App\Http\Controllers\User\IpnController;
use Bryceandy\Laravel_Pesapal\Http\Controllers\PaymentController;
use App\Http\Controllers\Authentication\Registration;
use App\Http\Controllers\Auth\CustomReg;
use Bryceandy\Laravel_Pesapal\Payment;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['mustbelogged'])->group(function(){
    Route::get('home',[FrontController::class,'index']);
    Route::get('prodpage',[FrontController::class,'products']);
    Route::get('cart',[FrontController::class,'cartpage']);
    Route::post('checkout',[FrontController::class,'checkout']);

    Route::get('viewproduct/{id}',[FrontController::class,'viewproduct']);
    Route::post('updatecart',[FrontController::class,'updatequantity']);
    Route::get('deletefromcart/{id}',[FrontController::class,'deletefromcart']);
    Route::get('viewprofile',[FrontController::class,'viewprofile']);
    Route::post('subquery',[FrontController::class,'submitquery']);
    Route::post('updateaccount',[FrontController::class,'updateuserprofile']);
    Route::get('filterbycate/{id}',[FrontController::class,'filterprodcategory']);
    Route::post('searchproduct', [FrontController::class,'searchproducts']);
    Route::get('filter_products', [FrontController::class,'filterbysort']);
    Route::get('viewreceipt/{id}',[FrontController::class,'viewreceipt']);
    Route::get('autocompleteproductlist_main', [FrontController::class,'AutoCompleteProductList']);

    


    Route::get('aboutus', function(){
        return view('user/aboutus');
    });
    Route::get('contacts', function(){
        return view('user/contact');
    });
    Route::get('return', function(){
        return view('user/return');
    });
    Route::get('shipping', function(){
        return view('user/shipping');
    });
    Route::get('terms', function(){
        return view('user/termsandconditions');
    });

});



Route::post('pesapal/iframe',[PaymentController::class,'store']) ->name('payment.store')->middleware('config');
Route::get('pesapal-ipn-listener', IpnController::class,'__invoke');






Route::get('register',[Registration::class,'registration'])->middleware(['alreadylogged','visitor']);
Route::get('login',[Registration::class,'login'])->middleware(['alreadylogged','visitor']);
Route::post('reg-user',[Registration::class,'storeuser']);
Route::post('authenticate-user',[Registration::class,'signin']);
Route::get('/',[Registration::class,'landingpage'])->middleware(['alreadylogged','visitor']);
Route::get('logout',[Registration::class,'logout']);

Route::get('productspreview',[Registration::class,'productspreview'])->middleware(['alreadylogged','visitor']);
Route::get('filter_products_registration', [Registration::class,'filterbysort']);
Route::get('filterbycateprev/{id}',[Registration::class,'filterprodcategory']);
Route::post('searchproductprev', [Registration::class,'searchproducts']);
Route::get('addtocart/{id}',[FrontController::class,'addtocart']);
Route::get('viewproductprev/{id}',[Registration::class,'viewproduct']);
Route::get('autocompleteproductlist_registration', [Registration::class,'AutoCompleteProductList']);










Route::middleware(['conAdmin'])->group(function(){
    Route::get('/dashboard',[FrontendController::class,'index']);


    Route::get('categories',[CategoryController::class,'index']);
    Route::get('add-category', [CategoryController::class,'add']);
    Route::post('insert-cate', [CategoryController::class,'insert']);
    Route::get('edit-category/{id}', [CategoryController::class,'edit']);
    Route::put('update-category/{id}', [CategoryController::class,'update']);
    Route::get('delete-category/{id}', [CategoryController::class,'delete']);
    Route::get('view-category/{id}',[CategoryController::class,'view']);
    
    
    Route::get('products',[ProductController::class,'index']);
    Route::get('add-Product', [ProductController::class,'add']);
    Route::get('edit-prod/{id}', [ProductController::class,'edit']);
    Route::post('insert-prod', [ProductController::class,'insert']);
    Route::put('update-prod/{id}', [ProductController::class,'update']);
    Route::get('delete-prod/{id}', [ProductController::class,'delete']);



    Route::get('discounts',[DiscountController::class,'index']);
    Route::get('add-discount', [DiscountController::class,'add']);
    Route::get('edit-discount/{id}', [DiscountController::class,'edit']);
    Route::post('insert-discount', [DiscountController::class,'insert']);
    Route::put('update-discount/{id}', [DiscountController::class,'update']);
    Route::get('delete-discount/{id}', [DiscountController::class,'delete']);
    
    
    Route::get('users', [UserController::class,'index']);
    Route::get('add-User', [UserController::class,'add']);
    Route::get('edit-user/{id}', [UserController::class,'edit']);
    Route::get('view-user/{id}', [UserController::class,'viewuser']);
    Route::get('adminprofile', [UserController::class,'viewprofile']);
    Route::post('adminprofileupdate', [UserController::class,'updateuserprofile']);
    Route::post('insert-user',  [UserController::class,'insert']);
    Route::put('update-user/{id}', [UserController::class,'update']);
    Route::get('delete-user/{id}', [UserController::class,'delete']);
    
    
    Route::get('orders', [OrderController::class,'orderlist']);
    Route::get('view-orderdetails/{id}', [OrderController::class,'vieworder']);
    Route::get('complete-order/{id}', [OrderController::class,'updateorder']);

    Route::get('messages', [MessagesController::class,'index']);
    Route::post('sendingquery', [MessagesController::class,'servicemessage']);

    Route::get('marketers', [MarketersController::class,'Index']);
    Route::get('add_invoice', [MarketersController::class,'AddInvoices']);
    Route::get('autocompletepromoter', [MarketersController::class,'AutoCompletePromoter']);
    Route::get('autocompleteproductlist', [MarketersController::class,'AutoCompleteProductList']);
    Route::get('getpromoter', [MarketersController::class,'GetPromoter']);

    
    Route::get('insert_invoice', [MarketersController::class,'InsertInvoice']);
    Route::get('view_invoices', [MarketersController::class,'ViewInvoices']);
    Route::get('edit_invoice/{id}', [MarketersController::class,'EditInvoices']);
    Route::get('update_invoice', [MarketersController::class,'UpdateInvoice']);
    Route::get('delete_invoice/{id}', [MarketersController::class,'DeleteInvoice']);


    
    Route::get('add_receipt', [MarketersController::class,'AddReceipt']);
    Route::get('insert_receipt', [MarketersController::class,'InsertReceipt']);
    Route::get('view_receipts', [MarketersController::class,'ViewReceipts']);
    Route::get('edit_receipt/{id}', [MarketersController::class,'EditReceipts']);
    Route::get('update_receipt', [MarketersController::class,'UpdateReceipt']);
    Route::get('delete_receipt/{id}', [MarketersController::class,'DeleteReceipt']);
    

    

    Route::get('diseases', [DiseaseController::class,'index']);
    Route::get('add-disease', [DiseaseController::class,'AddDisease']);
    Route::get('insert_disease', [DiseaseController::class,'InsertDisease']);
    Route::get('edit-disease/{id}', [DiseaseController::class,'Edit_disease']);
    Route::get('update_disease', [DiseaseController::class,'UpdateDisease']);
    Route::get('delete_disease/{id}', [DiseaseController::class,'DeleteDisease']);

    
});


 
