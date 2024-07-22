<?php

// app/Listeners/HandlePembayaranDeleted.php
namespace App\Listeners;

use App\Events\PembayaranDeleted;
use App\Models\Santri;
use App\Models\Pembayaran;

class HandlePembayaranDeleted
{
    public function handle(PembayaranDeleted $event)
    {
        $santriId = $event->santriId;
        $kelas = $event->kelas;
        $bulan = $event->bulan;

        // Panggil metode untuk menangani penghapusan
        $this->handlePembayaranDeleted($santriId, $kelas, $bulan);
    }

    private function handlePembayaranDeleted($santriId, $kelas, $bulan)
    {
        $santri = Santri::find($santriId);

        if ($santri) {
            $pembayaranLain = Pembayaran::where('santri_id', $santriId)
                ->where('kelas', $kelas)
                ->where('bulan', $bulan)
                ->exists();

            if (!$pembayaranLain) {
                $status = 'tagih';
            } else {
                $pembayaranTerakhir = Pembayaran::where('santri_id', $santriId)
                    ->where('kelas', $kelas)
                    ->where('bulan', $bulan)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($pembayaranTerakhir && $pembayaranTerakhir->status === 'setuju') {
                    $status = 'lunas';
                } elseif ($pembayaranTerakhir && $pembayaranTerakhir->status === 'belum setuju') {
                    $status = 'cek';
                } else {
                    $status = 'tagih';
                }
            }

            $santri->update(['status' => $status]);
        }
    }
}
