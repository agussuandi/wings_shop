<?php

namespace App\Models\MProducts;

use Illuminate\Database\Eloquent\Model;

class MProducts extends Model
{
    protected $table = 'm_products';
    protected $primaryKey = 'id';
    public $timestamps = false;
}