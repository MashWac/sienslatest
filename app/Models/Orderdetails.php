<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    use HasFactory;
    protected $table='orderdetails';
    protected $primaryKey='orderdetails_id';
    protected $fillable=['order_id','product_id','product_price','order_quantity','order_subtotal','created_at','updated_at','is_deleted'];


}
