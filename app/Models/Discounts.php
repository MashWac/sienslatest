<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;
    protected $table='tbl_discounts';
    protected $primaryKey='discount_id';
    protected $fillable=['discount_code','discount_percentage','created_at','updated_at','is_deleted'];
}
