<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Santri;
use App\KasMasuk;
use App\KasKeluar;
use App\Pembayaran;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pembayaran()
    {
        return view('laporan.pembayaran');
    }


    public function showLaporanPembayaranForm()
{
    // Ambil data santri dari database
    $santris = Santri::all(); // Ganti 'Santri' dengan nama model santri Anda

    // Kirimkan data santri ke view
    return view('laporan.pembayaran', compact('santris'));
}

public function pembayaranPdf(Request $request)
{
    $q = Pembayaran::query();

    // Filter berdasarkan status
    if ($request->has('status') && $request->status != '') {
        if ($request->status == 'belum setuju') {
            $q->where('status', 'belum setuju');
        } else {
            $q->where('status', 'setuju');
        }
    }

    // Filter berdasarkan santri_id
    if ($request->has('santri_id') && $request->santri_id != '') {
        $q->where('santri_id', $request->santri_id);
    }

    // Filter berdasarkan kelas
    if ($request->has('kelas') && $request->kelas != '') {
        $q->where('kelas', $request->kelas);
    }

    $datas = $q->get();

    $pdf = PDF::loadView('laporan.pembayaran_pdf', compact('datas'));
    return $pdf->download('laporan_pembayaran_' . date('Y-m-d_H-i-s') . '.pdf');
}

public function showLaporanKasmasukForm()
{
    return view('laporan.kasmasuk'); // Ganti dengan nama view yang sesuai
}

public function kasMasukPdf(Request $request)
{
    $q = KasMasuk::query();

    // Filter berdasarkan kategori
    if($request->get('kategori')) 
    {
        $q->where('kategori', $request->get('kategori'));
    }

    // Filter berdasarkan bulan
    if($request->get('start_month')) 
    {
        $startMonth = $request->get('start_month');
        $startDate = $startMonth . '-01'; // Tanggal pertama bulan
        $endDate = date('Y-m-t', strtotime($startDate)); // Tanggal terakhir bulan
        $q->whereBetween('tgl', [$startDate, $endDate]);
    }

    if($request->get('end_month')) 
    {
        $endMonth = $request->get('end_month');
        $startDate = $endMonth . '-01'; // Tanggal pertama bulan
        $endDate = date('Y-m-t', strtotime($startDate)); // Tanggal terakhir bulan
        $q->whereBetween('tgl', [$startDate, $endDate]);
    }

    $datas = $q->get();
    $totalNominal = $datas->sum('nominal');

    $pdf = PDF::loadView('laporan.kasmasuk_pdf', [
        'datas' => $datas,
        'kategori' => $request->get('kategori'),
        'startMonth' => $request->get('start_month'),
        'endMonth' => $request->get('end_month'),
        'totalNominal' => $totalNominal,
        'totalData' => $datas->count()
    ]);

    return $pdf->download('laporan_kas_masuk_' . date('Y-m-d_H-i-s') . '.pdf');
}

public function showLaporanKaskeluarForm()
{
    return view('laporan.kaskeluar'); // Ganti dengan nama view yang sesuai
}

public function kasKeluarPdf(Request $request)
{
    $q = KasKeluar::query();

    // Filter berdasarkan kategori
    if($request->get('kategori')) 
    {
        $q->where('kategori', $request->get('kategori'));
    }

    // Filter berdasarkan bulan
    if($request->get('start_month')) 
    {
        $startMonth = $request->get('start_month');
        $startDate = $startMonth . '-01'; // Tanggal pertama bulan
        $endDate = date('Y-m-t', strtotime($startDate)); // Tanggal terakhir bulan
        $q->whereBetween('tgl', [$startDate, $endDate]);
    }

    if($request->get('end_month')) 
    {
        $endMonth = $request->get('end_month');
        $startDate = $endMonth . '-01'; // Tanggal pertama bulan
        $endDate = date('Y-m-t', strtotime($startDate)); // Tanggal terakhir bulan
        $q->whereBetween('tgl', [$startDate, $endDate]);
    }

    $datas = $q->get();
    $totalNominal = $datas->sum('nominal');

    $pdf = PDF::loadView('laporan.kaskeluar_pdf', [
        'datas' => $datas,
        'kategori' => $request->get('kategori'),
        'startMonth' => $request->get('start_month'),
        'endMonth' => $request->get('end_month'),
        'totalNominal' => $totalNominal,
        'totalData' => $datas->count()
    ]);

    return $pdf->download('laporan_kas_keluar_' . date('Y-m-d_H-i-s') . '.pdf');
}

}
