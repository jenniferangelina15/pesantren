<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\Santri;
use App\KasMasuk;
use App\KasKeluar;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::get();
        $santri   = Santri::get();
        $kasmasuk = KasMasuk::get();
        $kaskeluar = KasKeluar::get();
        // Menghitung total nominal dari kasmasuk
        $totalKasMasuk = KasMasuk::sum('nominal');
        // Menghitung total nominal dari kaskeluar
        $totalKasKeluar = KasKeluar::sum('nominal');

        $datas = Pembayaran::where('status', 'belum setuju')->get();
        return view('home', compact('pembayaran', 'santri', 'datas', 'kasmasuk', 'kaskeluar', 'totalKasMasuk', 'totalKasKeluar'));
        return view('home');
    }
}
