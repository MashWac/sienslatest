<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='tbl_products';
    protected $primaryKey='product_id';
    protected $fillable=['product_name','product_description','category','unit_price','stock_available','prodpriority','product_image','created_at','updated_at','is_deleted'];
}
