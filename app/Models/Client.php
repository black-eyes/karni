<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operation;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable =["client_phone_no","client_name"];

    /**
     * get all client's operations
     */
    public function operations ()
    {
        return $this->hasMany(Operation::class);

    }
}
