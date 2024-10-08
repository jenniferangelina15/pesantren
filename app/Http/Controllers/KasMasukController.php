<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\KasMasuk;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class KasMasukController extends Controller
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

        $query = KasMasuk::query();

        if ($startMonth && $endMonth) {
            // Menggunakan Carbon untuk memformat tanggal
            $startDate = Carbon::createFromFormat('Y-m', $startMonth)->startOfMonth();
            $endDate = Carbon::createFromFormat('Y-m', $endMonth)->endOfMonth();

            $query->whereBetween('tgl', [$startDate, $endDate]);
        }

        $datas = $query->get();

        return view('kasmasuk.index', [
            'datas' => $datas,
            'filterStartMonth' => $startMonth,
            'filterEndMonth' => $endMonth,
        ]);
    }

    public function create()
    {
        return view('kasmasuk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kasmasuk = KasMasuk::create([
                'tgl' => $request->get('tgl'),
                'kategori' => $request->get('kategori'),
                'keterangan' => $request->get('keterangan'),
                'nominal' => $request->get('nominal')
            ]);

        alert()->success('Berhasil.','Data berhasil ditambahkan!');
        return redirect()->route('kasmasuk.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = KasMasuk::findOrFail($id);


        // if((Auth::user()->level == 'user') && (Auth::user()->customer->id != $data->customer_id)) {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }


        return view('kasmasuk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = KasMasuk::findOrFail($id);

        // if((Auth::user()->level == 'user') && (Auth::user()->customer->id != $data->customer_id)) {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }

        return view('kasmasuk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        KasMasuk::find($id)->update($request->all());
        
        alert()->success('Berhasil.','Data berhasil diubah!');
        return redirect()->route('kasmasuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KasMasuk::find($id)->delete();
        alert()->success('Berhasil.','Data berhasil dihapus!');
        return redirect()->route('kasmasuk.index');
    }
}
