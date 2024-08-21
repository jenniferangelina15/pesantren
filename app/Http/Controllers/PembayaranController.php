<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Santri;
use App\Pembayaran;
use App\KasMasuk;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Events\PembayaranDeleted;

class PembayaranController extends Controller
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


    public function index(Request $request)
    {
        $filterMonth = $request->input('filter_month');
        $filterYear = $request->input('filter_year');

        $query = Pembayaran::query();

        if ($filterMonth) {
            $query->where('bulan', $filterMonth);
        }

        if ($filterYear) {
            $query->whereYear('created_at', $filterYear);
        }

        $datas = $query->get();

        return view('pembayaran.index', compact('datas', 'filterMonth', 'filterYear'));
    }




    public function indexBelum()
    {
        $datas = Pembayaran::where('status', 'belum setuju')->get();
        return view('pembayaran.index', compact('datas'));
    }

    public function indexTelah()
    {
        $datas = Pembayaran::where('status', 'setuju')->get();
        return view('pembayaran.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $santri_id = null)
    {
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

        // Ambil query string 'santri_id' jika ada
        $santri_id = $request->query('santri_id', $santri_id);
        $santri = null;

        if ($santri_id) {
            $santri = Santri::find($santri_id);
        }

        $santris = Santri::get();
        return view('pembayaran.create', compact('santris', 'kode', 'santri', 'santri_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_pembayaran' => 'required|string|max:255',
            'santri_id' => 'required',
            'bukti' => 'file|mimes:jpg,png,jpeg|max:3050', // Max 3MB
        ]);

        if ($request->file('bukti')) {
            $file = $request->file('bukti');
            $dt = Carbon::now();
            $acak = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('bukti')->move("images/pembayaran", $fileName);
            $bukti = $fileName;
        } else {
            $bukti = NULL;
        }

        $santri = Santri::find($request->get('santri_id'));

        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => $request->get('kode_pembayaran'),
            'santri_id' => $request->get('santri_id'),
            'bukti' => $bukti,
            'bulan' => $request->get('bulan'),
            'kelas' => $request->get('kelas'),
            'nominal' => $request->get('nominal'),
            'status' => $request->get('status')
        ]);

        if ($request->get('status') == "setuju") {
            $santri->bulan_tagihan -= 1;
            // Tambahkan data ke tabel kasmasuk
            KasMasuk::create([
                'tgl' => now(),
                'kategori' => 'pembayaran',
                'keterangan' => $pembayaran->kode_pembayaran . ' | ' . $santri->nama . ' | ' . $pembayaran->kelas . ' | ' . $pembayaran->bulan,
                'nominal' => $pembayaran->nominal
            ]);
            $santri->save();
        }
        alert()->success('Berhasil.', 'Data berhasil ditambahkan!');
        return redirect()->back();
    }
    
    public function show($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('pembayaran.show', compact('data'));
    }

    // app/Http/Controllers/PembayaranController.php
    public function getDetails(Request $request)
    {
        $kodePembayaran = $request->kode_pembayaran;
        $pembayaran = Pembayaran::with('santri')->where('kode_pembayaran', $kodePembayaran)->first();

        return response()->json($pembayaran);
    }

    public function edit($id)
    {
        $data = Pembayaran::findOrFail($id);

        $santris = Santri::get();
        return view('pembayaran.edit', compact('santris', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bukti' => 'file|mimes:jpg,png,jpeg|max:3050', // Max 3MB
        ]);
        // Ambil data pembayaran berdasarkan $id
        $pembayaran = Pembayaran::findOrFail($id);

        // Simpan status lama
        $oldStatus = $pembayaran->status;

        // Proses upload bukti pembayaran jika ada
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move("images/pembayaran", $fileName);
            $bukti = $fileName;
        } else {
            $bukti = $pembayaran->bukti; // Tetap gunakan nilai bukti yang sudah ada jika tidak ada file baru diupload
        }

        // Lakukan pembaruan data pembayaran
        $pembayaran->update([
            'kode_pembayaran' => $request->input('kode_pembayaran'),
            'santri_id' => $request->input('santri_id'),
            'bulan' => $request->input('bulan'),
            'nominal' => $request->input('nominal'),
            'kelas' => $request->input('kelas'),
            'bukti' => $bukti,
            'status' => $request->input('status') // Perbarui status pembayaran
        ]);

        // Periksa apakah terjadi perubahan status
        if ($oldStatus !== $request->input('status')) {
            $santri = $pembayaran->santri; // Ambil data santri terkait

            // Jika status berubah dari "belum" ke "sudah"
            if ($oldStatus === 'belum setuju' && $request->input('status') === 'setuju') {
                $santri->update([
                    'bulan_tagihan' => $santri->bulan_tagihan - 1,
                ]);

                // Tambahkan data ke tabel kasmasuk
                KasMasuk::create([
                    'tgl' => now(),
                    'kategori' => 'pembayaran',
                    'keterangan' => $pembayaran->kode_pembayaran . ' | ' . $santri->nama . ' | ' . $pembayaran->kelas . ' | ' . $pembayaran->bulan,
                    'nominal' => $pembayaran->nominal
                ]);

                // Tampilkan pesan sukses dan redirect ke halaman indeks pembayaran
                alert()->success('Berhasil.', 'Data berhasil diubah!');
                return redirect()->back();
            } elseif ($oldStatus === 'setuju' && $request->input('status') === 'belum setuju') {
                // Jika status berubah dari "sudah" ke "belum"
                $santri->update([
                    'bulan_tagihan' => $santri->bulan_tagihan + 1,
                ]);

                // Tampilkan pesan sukses dan redirect ke halaman indeks pembayaran
                alert()->success('Berhasil.', 'Data berhasil diubah!');
                return redirect()->back();
            }
        }

        // Periksa apakah terjadi perubahan status
        if ($oldStatus === $request->input('status')) {
            $santri = $pembayaran->santri; // Ambil data santri terkait

            if ($oldStatus === 'belum setuju' && $request->input('status') === 'belum setuju') {
                // Tampilkan pesan sukses dan redirect ke halaman indeks pembayaran
                alert()->success('Berhasil.', 'Data berhasil diubah!');
                return redirect()->back();
            } elseif ($oldStatus === 'setuju' && $request->input('status') === 'setuju') {
                // Tampilkan pesan sukses dan redirect ke halaman indeks pembayaran
                alert()->success('Berhasil.', 'Data berhasil diubah!');
                return redirect()->back();
            }
        }
    }


    public function status(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);

        $pembayaran->update([
            'status' => 'setuju'
        ]);

        //tagihan berkurang 1 bulan
        $pembayaran->santri->where('id', $pembayaran->santri->id)
            ->update([
                'bulan_tagihan' => ($pembayaran->santri->bulan_tagihan - 1),
            ]);


        alert()->success('Berhasil.', 'Data berhasil diubah!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if ($pembayaran) {
            // Ambil data yang diperlukan untuk event
            $santriId = $pembayaran->santri_id;
            $kelas = $pembayaran->kelas;
            $bulan = $pembayaran->bulan;

            // Hapus data pembayaran
            $pembayaran->delete();

            // Trigger event
            event(new PembayaranDeleted($santriId, $kelas, $bulan));
            alert()->success('Berhasil.', 'Data berhasil dihapus!');
            return redirect()->back();
        }
    }

}
