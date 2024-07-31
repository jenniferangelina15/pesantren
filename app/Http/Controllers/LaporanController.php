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
    if ($request->get('kategori')) {
        $q->where('kategori', $request->get('kategori'));
    }

    // Filter berdasarkan bulan
    if ($request->get('start_month') || $request->get('end_month')) {
        $startMonth = $request->get('start_month');
        $endMonth = $request->get('end_month');

        if ($startMonth) {
            $startDate = $startMonth . '-01'; // Tanggal pertama bulan
        } else {
            $startDate = '1900-01-01'; // Tanggal awal yang sangat lama jika tidak ada start_month
        }

        if ($endMonth) {
            $endDate = $endMonth . '-01'; // Tanggal pertama bulan akhir
            $endDate = date('Y-m-t', strtotime($endDate)); // Tanggal terakhir bulan
        } else {
            $endDate = date('Y-m-d'); // Tanggal hari ini jika tidak ada end_month
        }

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
    if ($request->get('kategori')) {
        $q->where('kategori', $request->get('kategori'));
    }

    // Filter berdasarkan bulan
    if ($request->get('start_month') || $request->get('end_month')) {
        $startMonth = $request->get('start_month');
        $endMonth = $request->get('end_month');

        if ($startMonth) {
            $startDate = $startMonth . '-01'; // Tanggal pertama bulan
        } else {
            $startDate = '1900-01-01'; // Tanggal awal yang sangat lama jika tidak ada start_month
        }

        if ($endMonth) {
            $endDate = $endMonth . '-01'; // Tanggal pertama bulan akhir
            $endDate = date('Y-m-t', strtotime($endDate)); // Tanggal terakhir bulan
        } else {
            $endDate = date('Y-m-d'); // Tanggal hari ini jika tidak ada end_month
        }

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

    public function showLaporanKasForm()
    {
    return view('laporan.kas'); // Ganti dengan nama view yang sesuai
    }

    public function kasPdf(Request $request)
    {
        $kasMasukQuery = KasMasuk::query();
        $kasKeluarQuery = KasKeluar::query();
    
        // Filter kas masuk berdasarkan kategori
        if ($request->get('kategori_masuk')) {
            $kasMasukQuery->where('kategori', $request->get('kategori_masuk'));
        }
    
        // Filter kas masuk berdasarkan bulan
        if ($request->get('start_month_masuk') || $request->get('end_month_masuk')) {
            $startMonthMasuk = $request->get('start_month_masuk');
            $endMonthMasuk = $request->get('end_month_masuk');
    
            if ($startMonthMasuk) {
                $startDateMasuk = $startMonthMasuk . '-01'; // Tanggal pertama bulan
            } else {
                $startDateMasuk = '1900-01-01'; // Tanggal awal yang sangat lama jika tidak ada start_month
            }
    
            if ($endMonthMasuk) {
                $endDateMasuk = $endMonthMasuk . '-01'; // Tanggal pertama bulan akhir
                $endDateMasuk = date('Y-m-t', strtotime($endDateMasuk)); // Tanggal terakhir bulan
            } else {
                $endDateMasuk = date('Y-m-d'); // Tanggal hari ini jika tidak ada end_month
            }
    
            $kasMasukQuery->whereBetween('tgl', [$startDateMasuk, $endDateMasuk]);
        }
    
        // Filter kas keluar berdasarkan kategori
        if ($request->get('kategori_keluar')) {
            $kasKeluarQuery->where('kategori', $request->get('kategori_keluar'));
        }
    
        // Filter kas keluar berdasarkan bulan
        if ($request->get('start_month_keluar') || $request->get('end_month_keluar')) {
            $startMonthKeluar = $request->get('start_month_keluar');
            $endMonthKeluar = $request->get('end_month_keluar');
    
            if ($startMonthKeluar) {
                $startDateKeluar = $startMonthKeluar . '-01'; // Tanggal pertama bulan
            } else {
                $startDateKeluar = '1900-01-01'; // Tanggal awal yang sangat lama jika tidak ada start_month
            }
    
            if ($endMonthKeluar) {
                $endDateKeluar = $endMonthKeluar . '-01'; // Tanggal pertama bulan akhir
                $endDateKeluar = date('Y-m-t', strtotime($endDateKeluar)); // Tanggal terakhir bulan
            } else {
                $endDateKeluar = date('Y-m-d'); // Tanggal hari ini jika tidak ada end_month
            }
    
            $kasKeluarQuery->whereBetween('tgl', [$startDateKeluar, $endDateKeluar]);
        }
    
        $kasMasuk = $kasMasukQuery->get();
        $kasKeluar = $kasKeluarQuery->get();
    
        $totalMasuk = $kasMasuk->sum('nominal');
        $totalKeluar = $kasKeluar->sum('nominal');
    
        $pdf = PDF::loadView('laporan.kas_pdf', [
            'kasMasuk' => $kasMasuk,
            'kasKeluar' => $kasKeluar,
            'kategoriMasuk' => $request->get('kategori_masuk'),
            'startMonthMasuk' => $request->get('start_month_masuk'),
            'endMonthMasuk' => $request->get('end_month_masuk'),
            'kategoriKeluar' => $request->get('kategori_keluar'),
            'startMonthKeluar' => $request->get('start_month_keluar'),
            'endMonthKeluar' => $request->get('end_month_keluar'),
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'totalDataMasuk' => $kasMasuk->count(),
            'totalDataKeluar' => $kasKeluar->count()
        ]);
    
        return $pdf->download('laporan_kas_' . date('Y-m-d_H-i-s') . '.pdf');
    }
    
}
