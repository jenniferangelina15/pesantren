<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\Santri;
use App\KasMasuk;
use App\KasKeluar;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;

class WaliController extends Controller
{
    public function index()
    {
        $datas = Santri::get();
        return view('wali.LoginWali', compact('datas'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        $santri = Santri::where('nik', $request->nik)->first();

        if ($santri && Hash::check($request->password, $santri->password)) {
            // Simpan NIK di session
            $request->session()->put('nik', $santri->nik);

            // Redirect ke halaman index
            return redirect()->route('wali.dataBayar');
        } else {
            return back()->withErrors([
                'nik' => 'NIK salah.',
                'password' => 'Password salah.',
            ]);
        }
    }

    public function dataBayar(Request $request)
    {
        // Mengambil NIK dari session
        $nik = $request->session()->get('nik');

        // Temukan santri berdasarkan NIK
        $santri = Santri::where('nik', $nik)->first();

        if (!$santri) {
            Alert::error('Error', 'Santri tidak ditemukan.');
            return redirect('/loginWali');
        }

        // Logika pembuatan kode pembayaran
        $getRow = Pembayaran::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();
        $kode = "P00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "P0000" . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "P000" . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "P00" . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "P0" . ($lastId->id + 1);
            } else {
                $kode = "P" . ($lastId->id + 1);
            }
        }

        // Ambil semua pembayaran untuk santri
        $pembayarans = Pembayaran::where('santri_id', $santri->id)->get();

        // Ambil semua kelas untuk opsi filter dan urutkan
        $kelasOptions = Pembayaran::distinct()->pluck('kelas')->sort()->values();

        return view('wali.dataBayar', [
            'santri' => $santri,
            'pembayarans' => $pembayarans,
            'kelasOptions' => $kelasOptions,
            'kode' => $kode,
        ]);
    }

    public function dataKas(Request $request)
{
    $pembayaran = Pembayaran::get();
    $santri = Santri::get();
    $totalKasMasuk = KasMasuk::sum('nominal');
    $totalKasKeluar = KasKeluar::sum('nominal');

    $startMonth = $request->input('start_month');
    $endMonth = $request->input('end_month');

    $query = KasKeluar::query();

    if ($startMonth && $endMonth) {
        $startDate = Carbon::createFromFormat('Y-m', $startMonth)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $endMonth)->endOfMonth();

        $query->whereBetween('tgl', [$startDate, $endDate]);
    }

    $kaskeluar = $query->get();
    $kasmasuk = KasMasuk::get();

    return view('wali.dataKas', compact('pembayaran', 'santri', 'kasmasuk', 'kaskeluar', 'totalKasMasuk', 'totalKasKeluar', 'startMonth', 'endMonth'));
}



    public function logout()
    {
        return view('wali.loginWali');
    }

}
