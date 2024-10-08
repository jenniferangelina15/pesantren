<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pembayaran;
use App\Santri;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class SantriController extends Controller
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

    public function index()
    {
        $datas = Santri::get();
        return view('santri.index', compact('datas'));
    }

    public function indexWali()
    {
        if (Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $datas = User::get();
        return view('auth.user', compact('datas'));
    }

    public function index10()
    {
        $datas = Santri::where('kelas', '10')->get();
        return view('santri.index', compact('datas'));
    }

    public function index11()
    {
        $datas = Santri::where('kelas', '11')->get();
        return view('santri.index', compact('datas'));
    }

    public function index12()
    {
        $datas = Santri::where('kelas', '12')->get();
        return view('santri.index', compact('datas'));
    }
    public function indexAlumni()
    {
        $datas = Santri::where('kelas', 'alumni')->get();
        return view('santri.index', compact('datas'));
    }

    public function create()
    {
        return view('santri.create');
    }

    public function store(Request $request)
    {
        $count = Santri::where('nik', $request->input('nik'))->count();

        if ($count > 0) {
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
            return redirect()->to('santri');
        }

        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:santri',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Santri::create([
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'kelas' => $request->input('kelas'),
            'wali' => $request->input('wali'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'jk' => $request->input('jk'),
            'status' => $request->input('status'),
            'bulan_tagihan' => $request->input('bulan_tagihan'),
            'password' => bcrypt(($request->input('password'))),
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->back();
    }

    public function show($id)
    {
        $data = Santri::findOrFail($id);

        // Ambil semua pembayaran untuk santri
        $pembayarans = Pembayaran::where('santri_id', $data->id)->get();

        // Ambil semua kelas untuk opsi filter dan urutkan
        $kelasOptions = Pembayaran::distinct()->pluck('kelas')->sort()->values();

        return view('santri.show', compact('data', 'pembayarans', 'kelasOptions'));
    }

    public function showPembayaran($id)
    {

        $data = Santri::findOrFail($id);
        $pembayarans = Pembayaran::where('santri_id', $id)->get();
        return view('santri.showPembayaran', compact('data', 'pembayarans'));
    }

    public function edit($id)
    {
        $data = Santri::findOrFail($id);
        return view('santri.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $santri_data = Santri::findOrFail($id);

        // Jika password diinput, hash password baru
        if ($request->input('password')) {
            $santri_data->password = bcrypt($request->input('password'));
        }

        // Update data lain
        $santri_data->fill($request->except('password')); // Jangan update password lagi
        $santri_data->save(); // Simpan perubahan

        // Redirect dan alert sesuai dengan kelas
        switch ($santri_data->kelas) {
            case 10:
                alert()->success('Berhasil.', 'Data telah diubah!');
                return redirect()->route('santri.index10');
            case 11:
                alert()->success('Berhasil.', 'Data telah diubah!');
                return redirect()->route('santri.index11');
            case 12:
                alert()->success('Berhasil.', 'Data telah diubah!');
                return redirect()->route('santri.index12');
            case 'alumni':
                alert()->success('Berhasil.', 'Data telah diubah!');
                return redirect()->route('santri.indexAlumni');
            default:
                alert()->success('Berhasil.', 'Data telah diubah!');
                return redirect()->route('santri.index');
        }
    }

    public function updateKelas($id)
    {
        $santri = Santri::findOrFail($id);

        if ($santri->bulan_tagihan == 0) {

            if ($santri->kelas == 12) {
                $santri->kelas = 'alumni';
                $santri->save();
                alert()->success('Berhasil.', 'Data telah diupdate!');
            } else {
                $santri->kelas += 1; // Increment kelas
                $santri->bulan_tagihan = 12; // Set bulan_tagihan ke 12
                $santri->status = 'tagih'; // Set tagihan
                $santri->save();
            }

            alert()->success('Berhasil.', 'Data telah diupdate!');
        } else {
            alert()->error('Gagal.', 'Bulan Tagihan harus 0 untuk melakukan update.');
        }


        return redirect()->route('santri.show', $id);
    }

    // Metode untuk mengupdate seluruh status santri menjadi "tagih"
    public function updateStatus()
    {
        // Ambil semua santri yang kelasnya bukan 'alumni'
        $santris = Santri::where('kelas', '!=', 'alumni')->get();

        foreach ($santris as $santri) {

            $bulanIndonesia = [
                1 => 'januari', 'februari', 'maret', 'april', 'mei', 'juni',
                'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
            ];
            $bulanSaatIni = $bulanIndonesia[date('n')];
            // Ambil data pembayaran terbaru untuk santri tersebut di kelas dan bulan saat ini
            $pembayaran = Pembayaran::where('santri_id', $santri->id)
                            ->where('kelas', $santri->kelas)
                            ->where('bulan', $bulanSaatIni)
                            ->latest()
                            ->first();

            // Tentukan status berdasarkan data pembayaran
            if ($pembayaran) {
                if ($pembayaran->status == 'belum setuju') {
                    $santri->status = 'cek';
                } elseif ($pembayaran->status == 'setuju') {
                    $santri->status = 'lunas';
                }
            } else {
                $santri->status = 'tagih';
            }

            // Simpan perubahan status
            $santri->save();
        }

        // Kirimkan notifikasi atau pesan sukses
        return redirect()->back()->with('success', 'Status seluruh santri berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Temukan santri berdasarkan ID
    $santri = Santri::find($id);

    // Periksa jika santri tidak ditemukan
    if (!$santri) {
        return redirect()->back()->with('error', 'Santri tidak ditemukan!');
    }

    // Periksa jika ada pembayaran yang terkait dengan santri ini
    $pembayaran = Pembayaran::where('santri_id', $id)->exists();

    if ($pembayaran) {
        // Jika ada data pembayaran yang terkait, tampilkan pesan error
        alert()->error('Gagal.', 'Santri ini memiliki data pembayaran yang terkait!');
        return redirect()->back();
    }

    // Jika tidak ada data pembayaran yang terkait, hapus santri
    $santri->delete();
    alert()->success('Berhasil.', 'Data telah dihapus!');
    return redirect()->back();
}

}
