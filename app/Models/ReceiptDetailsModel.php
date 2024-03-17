<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetailsModel extends Model
{
    use HasFactory;
    protected $table='tbl_receipts_details';
    protected $primaryKey='receipt_details_id';
    protected $fillable=['product_id','quantity','receipt_number','created_at','updated_at','is_deleted'];
}