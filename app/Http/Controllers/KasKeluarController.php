<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\KasKeluar;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class KasKeluarController extends Controller
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
        $startMonth = $request->input('start_month');
        $endMonth = $request->input('end_month');

        $query = KasKeluar::query();

        if ($startMonth && $endMonth) {
            // Menggunakan Carbon untuk memformat tanggal
            $startDate = Carbon::createFromFormat('Y-m', $startMonth)->startOfMonth();
            $endDate = Carbon::createFromFormat('Y-m', $endMonth)->endOfMonth();

            $query->whereBetween('tgl', [$startDate, $endDate]);
        }

        $datas = $query->get();

        return view('kaskeluar.index', [
            'datas' => $datas,
            'filterStartMonth' => $startMonth,
            'filterEndMonth' => $endMonth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kaskeluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kaskeluar = KasKeluar::create([
                'tgl' => $request->get('tgl'),
                'kategori' => $request->get('kategori'),
                'keterangan' => $request->get('keterangan'),
                'nominal' => $request->get('nominal')
            ]);

        alert()->success('Berhasil.','Data berhasil ditambahkan!');
        return redirect()->route('kaskeluar.index');
    }

    public function show($id)
    {
        $data = KasKeluar::findOrFail($id);
        return view('kaskeluar.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = KasKeluar::findOrFail($id);
        return view('kaskeluar.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        KasKeluar::find($id)->update($request->all());
        
        alert()->success('Berhasil.','Data berhasil diubah!');
        return redirect()->route('kaskeluar.index');
    }

    public function destroy($id)
    {
        KasKeluar::find($id)->delete();
        alert()->success('Berhasil.','Data berhasil dihapus!');
        return redirect()->route('kaskeluar.index');
    }
}
