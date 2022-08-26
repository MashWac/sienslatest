<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table='country';
    protected $primaryKey='country_id';
    protected $fillable=['iso','name', 'nickname','numcode','phone_code'];
}
