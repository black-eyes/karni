<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';

    protected  $filable = ["shop_name","phone_no","app_lang","password"];


    /**
     * get all client's operations
     */
    public function operations ()
    {
        return $this->hasMany(Client::class);

    }


}
