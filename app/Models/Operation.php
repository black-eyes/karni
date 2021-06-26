<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $table = 'operations';
    protected $fillable = ["client_id","type_operation","note_operation","date_operation","image_operation","amount"];
}
