<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kostum;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KostumController extends Controller
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
        // if(Auth::user()->level == 'user') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/');
        // }

        $datas = Kostum::get();
        return view('kostum.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Auth::user()->level == 'user') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/');
        // }

        return view('kostum.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kostum' => 'required|string|max:255',
            'harga' => 'required'
        ]);

        if($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/kostum", $fileName);
            $gambar = $fileName;
        } else {
            $gambar = NULL;
        }

        Kostum::create([
                'kostum' => $request->get('kostum'),
                'harga' => $request->get('harga'),
                'jumlah_kostum' => $request->get('jumlah_kostum'),
                'deskripsi' => $request->get('deskripsi'),
                'gambar' => $gambar
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('kostum.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(Auth::user()->level == 'user') {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }

        $data = Kostum::findOrFail($id);

        return view('kostum.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        // if(Auth::user()->level == 'user') {
        //         Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //         return redirect()->to('/');
        // }

        $data = Kostum::findOrFail($id);
        return view('kostum.edit', compact('data'));
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
        if($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/kostum", $fileName);
            $gambar = $fileName;
        } else {
            $gambar = NULL;
        }

        Kostum::find($id)->update([
             'kostum' => $request->get('kostum'),
                'harga' => $request->get('harga'),
                'jumlah_kostum' => $request->get('jumlah_kostum'),
                'deskripsi' => $request->get('deskripsi'),
                'gambar' => $gambar
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('kostum.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kostum::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('kostum.index');
    }
}
