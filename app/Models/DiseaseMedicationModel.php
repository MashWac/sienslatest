<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseMedicationModel extends Model
{
    use HasFactory;
    protected $table='tbl_diseases_medications';
    protected $primaryKey='diseasemedication_id';
    protected $fillable=['disease_id','medication_id','created_at','updated_at','is_deleted'];
}
