<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kostum extends Model
{
    protected $table = 'kostum';
    protected $fillable = ['kostum', 'harga', 'jumlah_kostum', 'deskripsi', 'gambar'];

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
}
