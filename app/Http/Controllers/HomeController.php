<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\Santri;
use App\KasMasuk;
use App\KasKeluar;
use Auth;
use DB;


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

    public function getKasByCategory() {
        $kasMasuk = DB::table('kasmasuk')
            ->select(DB::raw('kategori, SUM(nominal) as total'))
            ->groupBy('kategori')
            ->get();
    
        $kasKeluar = DB::table('kaskeluar')
            ->select(DB::raw('kategori, SUM(nominal) as total'))
            ->groupBy('kategori')
            ->get();
    
        return response()->json([
            'kasMasuk' => $kasMasuk,
            'kasKeluar' => $kasKeluar,
        ]);
    }

    public function getNominalKasByYear() {
        $kasMasuk = DB::table('kasmasuk')
            ->select(DB::raw('YEAR(tgl) as year, SUM(nominal) as total'))
            ->groupBy(DB::raw('YEAR(tgl)'))
            ->get();
    
        $kasKeluar = DB::table('kaskeluar')
            ->select(DB::raw('YEAR(tgl) as year, SUM(nominal) as total'))
            ->groupBy(DB::raw('YEAR(tgl)'))
            ->get();
    
        // Menggabungkan data kas masuk dan kas keluar berdasarkan tahun
        $data = [];
        foreach ($kasMasuk as $masuk) {
            $data[$masuk->year]['kasMasuk'] = $masuk->total;
            $data[$masuk->year]['kasKeluar'] = 0;
        }
    
        foreach ($kasKeluar as $keluar) {
            if (isset($data[$keluar->year])) {
                $data[$keluar->year]['kasKeluar'] = $keluar->total;
            } else {
                $data[$keluar->year]['kasMasuk'] = 0;
                $data[$keluar->year]['kasKeluar'] = $keluar->total;
            }
        }
    
        // Menghitung nominal kas
        $nominalKas = [];
        foreach ($data as $year => $values) {
            $nominalKas[] = [
                'year' => $year,
                'nominal' => $values['kasMasuk'] - $values['kasKeluar']
            ];
        }
    
        return response()->json($nominalKas);
    }

    public function getKasComparison()
    {
        // Ambil data kas masuk
        $kasMasuk = DB::table('kasmasuk')
            ->select(DB::raw('SUM(nominal) as total_nominal'))
            ->pluck('total_nominal')
            ->first();

        // Ambil data kas keluar
        $kasKeluar = DB::table('kaskeluar')
            ->select(DB::raw('SUM(nominal) as total_nominal'))
            ->pluck('total_nominal')
            ->first();

        // Return data dalam format JSON
        return response()->json([
            'kasMasuk' => $kasMasuk,
            'kasKeluar' => $kasKeluar,
        ]);
    }
    
    public function getNominalKeluarByCategory()
    {
        $data = DB::table('kaskeluar')
            ->select('kategori', DB::raw('SUM(nominal) as total_nominal'))
            ->groupBy('kategori')
            ->get();

        return response()->json($data);
    }

    public function getNominalMasukByCategory()
    {
        $data = DB::table('kasmasuk')
            ->select('kategori', DB::raw('SUM(nominal) as total_nominal'))
            ->groupBy('kategori')
            ->get();

        return response()->json($data);
    }
    
}

