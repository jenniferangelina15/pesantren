<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    protected $table = 'kasmasuk';
    protected $fillable = ['tgl', 'kategori', 'keterangan', 'nominal'];
}
