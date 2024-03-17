<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailsModel extends Model
{
    use HasFactory;
    protected $table='tbl_invoice_details';
    protected $primaryKey='invoice_details_id';
    protected $fillable=['product_id','quantity','invoice_number','created_at','updated_at','is_deleted'];
}

