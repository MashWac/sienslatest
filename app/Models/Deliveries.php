<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;

    protected $table='delivery';
    protected $primaryKey='delivery_id';
    protected $fillable=['town','address', 'order_id','delivery_status','created_at','updated_at','is_deleted'];
}
