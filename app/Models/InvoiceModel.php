<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    use HasFactory;
    protected $table='tbl_invoice';
    protected $primaryKey='invoice_id';
    protected $fillable=['invoice_number','promoter_id','invoice_date','created_at','updated_at','is_deleted'];
}
