<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseModel extends Model
{
    use HasFactory;
    protected $table='tbl_diseases';
    protected $primaryKey='disease_id';
    protected $fillable=['disease_name','short_description','information','created_at','updated_at','is_deleted'];
}
