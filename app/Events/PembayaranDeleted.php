<?php

// app/Events/PembayaranDeleted.php
namespace App\Events;

use Illuminate\Queue\SerializesModels;

class PembayaranDeleted
{
    use SerializesModels;

    public $santriId;
    public $kelas;
    public $bulan;

    public function __construct($santriId, $kelas, $bulan)
    {
        $this->santriId = $santriId;
        $this->kelas = $kelas;
        $this->bulan = $bulan;
    }
}

