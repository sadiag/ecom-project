<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model

{    protected $fillable = [
    'product_id', 'product_qty','price','user_ip',
     ];

}
