<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    protected $table = 'kaskeluar';
    protected $fillable = ['tgl', 'kategori', 'keterangan', 'nominal'];
}
