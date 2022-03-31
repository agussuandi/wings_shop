<?php

namespace App\Models\TrxHPenjualan;

use Illuminate\Database\Eloquent\Model;

class TrxHPenjualan extends Model
{
    protected $table = 'trx_h_penjualan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function trxDetail()
    {
        return $this->hasMany(\App\Models\TrxDPenjualan\TrxDPenjualan::class, 'trx_h_id', 'id');
    }
}