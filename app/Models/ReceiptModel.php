<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptModel extends Model
{
    use HasFactory;
    protected $table='tbl_receipts';
    protected $primaryKey='receipt_id';
    protected $fillable=['receipt_number','promoter_id','receipt_date','created_at','updated_at','is_deleted'];
}
