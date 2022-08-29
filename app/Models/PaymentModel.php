<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table='pesapal_payments';
    protected $primaryKey='id';
    protected $fillable=['email','currency','payment_method','reference','created_at','updated_at'];

}
