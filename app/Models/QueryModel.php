<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryModel extends Model
{
    use HasFactory;
    protected $table='tbl_queries';
    protected $primaryKey='query_id';
    protected $fillable=['user_id','question','created_at','updated_at','is_deleted'];

}
