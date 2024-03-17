<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
    use HasFactory;
    protected $table='tbl_messages';
    protected $primaryKey='message_id';
    protected $fillable=['user_id','question','serviced','created_at','updated_at','is_deleted'];
}
