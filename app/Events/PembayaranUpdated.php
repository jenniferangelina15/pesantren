<?php

namespace App\Events;

use App\Pembayaran;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PembayaranUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pembayaran;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Pembayaran $pembayaran
     * @return void
     */
    public function __construct(Pembayaran $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }
}

