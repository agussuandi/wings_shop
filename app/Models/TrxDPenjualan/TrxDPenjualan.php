<?php

namespace App\Models\TrxDPenjualan;

use Illuminate\Database\Eloquent\Model;

class TrxDPenjualan extends Model
{
    protected $table = 'trx_d_penjualan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(\App\Models\MProducts\MProducts::class, 'id', 'product_id');
    }
}