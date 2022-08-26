<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $primaryKey='order_id';
    protected $fillable=['user_id','order_amount','payment_id','order_status','created_at','updated_at','is_deleted'];

}
