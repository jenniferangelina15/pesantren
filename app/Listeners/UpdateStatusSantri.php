<?php

namespace App\Listeners;

use App\Events\PembayaranUpdated;
use App\Santri;
use App\Pembayaran; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStatusSantri
{
    /**
     * Handle the event.
     *
     * @param \App\Events\PembayaranUpdated $event
     * @return void
     */
    public function handle(PembayaranUpdated $event)
{
    $pembayaran = $event->pembayaran;

    // Ambil bulan saat ini
    $bulanIndonesia = [
        1 => 'januari', 'februari', 'maret', 'april', 'mei', 'juni',
        'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
    ];
    $bulanSaatIni = $bulanIndonesia[date('n')];

    // Ambil santri terkait
    $santri = Santri::find($pembayaran->santri_id);

    if ($santri) {
        // Cek pembayaran lain untuk santri
        $pembayaranLain = Pembayaran::where('santri_id', $santri->id)
            ->where('kelas', $santri->kelas)
            ->where('bulan', $bulanSaatIni)
            ->first();

        if (!$pembayaranLain) {
            // Tidak ada pembayaran untuk bulan ini, set status ke 'tagih'
            $status = 'tagih';
        } else {
            // Jika ada pembayaran lain
            if ($pembayaranLain->status === 'setuju') {
                $status = 'lunas';
            } elseif ($pembayaranLain->status === 'belum setuju') {
                $status = 'cek';
            } else {
                $status = 'tagih';
            }
        }

        // Update status santri
        $santri->update(['status' => $status]);
    }
}


}
