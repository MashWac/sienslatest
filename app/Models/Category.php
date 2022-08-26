<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='tbl_categories';
    protected $primaryKey='category_id';
    protected $fillable=['category_name','category_banner','popularity', 'created_at','updated_at','is_deleted'];
}
