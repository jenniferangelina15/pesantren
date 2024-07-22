<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'customer_id', 'kostum_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'total_harga'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function kostum()
    {
    	return $this->belongsTo(Kostum::class);
    }
}
