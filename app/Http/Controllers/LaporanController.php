<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kostum;
use App\Customer;
use App\Transaksi;
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

    public function kostum()
    {
        return view('laporan.kostum');
    }

    public function kostumPdf()
    {

        $datas = Kostum::all();
        $pdf = PDF::loadView('laporan.kostum_pdf', compact('datas'));
        return $pdf->download('laporan_kostum_'.date('Y-m-d_H-i-s').'.pdf');
    }

public function transaksi()
    {

        return view('laporan.transaksi');
    }


    public function transaksiPdf(Request $request)
    {
        $q = Transaksi::query();

        if($request->get('status')) 
        {
             if($request->get('status') == 'sewa') {
                $q->where('status', 'sewa');
            } else {
                $q->where('status', 'kembali');
            }
        }

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('customer_id', Auth::user()->customer->id);
        // }
        
        $datas = $q->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas'));
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }


// // public function transaksiExcel(Request $request)
// //     {
// //         $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s');
// //         Excel::create($nama, function ($excel) use ($request) {
// //         $excel->sheet('Laporan Data Transaksi', function ($sheet) use ($request) {
        
// //         $sheet->mergeCells('A1:H1');

// //        // $sheet->setAllBorders('thin');
// //         $sheet->row(1, function ($row) {
// //             $row->setFontFamily('Calibri');
// //             $row->setFontSize(11);
// //             $row->setAlignment('center');
// //             $row->setFontWeight('bold');
// //         });

// //         $sheet->row(1, array('LAPORAN DATA TRANSAKSI'));

// //         $sheet->row(2, function ($row) {
// //             $row->setFontFamily('Calibri');
// //             $row->setFontSize(11);
// //             $row->setFontWeight('bold');
// //         });

// //         $q = Transaksi::query();

// //         if($request->get('status')) 
// //         {
// //              if($request->get('status') == 'sewa') {
// //                 $q->where('status', 'sewa');
// //             } else {
// //                 $q->where('status', 'kembali');
// //             }
// //         }

// //         if(Auth::user()->level == 'user')
// //         {
// //             $q->where('customer_id', Auth::user()->customer->id);
// //         }

// //         $datas = $q->get();

// //        // $sheet->appendRow(array_keys($datas[0]));
// //         $sheet->row($sheet->getHighestRow(), function ($row) {
// //             $row->setFontWeight('bold');
// //         });

// //          $datasheet = array();
// //          $datasheet[0]  =   array("No", "Kode Transaksi", "Kostum", "Customer", "Tgl Sewa","Tgl Kembali", "Totla Harga", "Status");
// //          $i=1;

// //         foreach ($datas as $data) {

// //            // $sheet->appendrow($data);
// //           $datasheet[$i] = array($i,
// //                         $data['kode_transaksi'],
// //                         $data->kostum->kostum,
// //                         $data->customer->nama,
// //                         date('d/m/y', strtotime($data['tgl_pinjam'])),
// //                         date('d/m/y', strtotime($data['tgl_kembali'])),
// //                         $data['total_harga'],
// //                         $data['status']
// //                     );
          
// //           $i++;
// //         }

// //         $sheet->fromArray($datasheet);
// //     });

// // })->export('xls');

// }
}
