<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsModel extends Model
{
    use HasFactory;
    protected $table='tbl_visits';
    protected $primaryKey='visitor_id';

    protected $fillable = [
        'visitor_ip',
        'created_at',
        'updated_at',
        'is_deleted'

    ];
}

