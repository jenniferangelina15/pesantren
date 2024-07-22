<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\PembayaranUpdated;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['kode_pembayaran', 'santri_id', 'kelas', 'bukti', 'status', 'bulan', 'nominal'];

    public function santri()
    {
    	return $this->belongsTo(Santri::class);
    }

    protected $dispatchesEvents = [
        'saved' => PembayaranUpdated::class,
    ];
}
