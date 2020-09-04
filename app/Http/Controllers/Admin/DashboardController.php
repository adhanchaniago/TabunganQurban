<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BelanjaSapi;
use App\BelanjaPakan;
use App\GajiKaryawan;
use App\AnggaranPakan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(BelanjaSapi $belanjaSapi)
    {
        $jumlah_sapi_semua =  $belanjaSapi->sum_sapi();
        $jumlah_invest = $belanjaSapi->sum_total_harga();
        $sapi = array($jumlah_sapi_semua, $jumlah_invest[0]);

//        return $sapi;
		return view('admin.dashboard.index',compact('sapi'));
	}

	public function anggaran_pakan(Request $request, BelanjaPakan $belanjaPakan){
	    if(count($request)){
            $tanggal_awal = date("Y-m-01");
            $tanggal_akhir = date("Y-m-t");
            $bulan = date("Y-F");
        }
        else{
            $tanggal_awal = date("Y-m-01");
            $tanggal_akhir = date("Y-m-t");
            $bulan = date("Y-F");

        }
        $pengeluaran = BelanjaPakan::select(DB::raw('sum(total_harga) as total_harga'))->whereBetween('tanggal_pembelian',[$tanggal_awal, $tanggal_akhir])->get();
        $anggaran_pakan = AnggaranPakan::select('jumlah_anggaran')->whereBetween('updated_at',[$tanggal_awal, $tanggal_akhir])->get();
        $data = array($anggaran_pakan, $pengeluaran, $bulan);
        return response()->json($data,200);
    }
    public function getdatasapi(){
	    $sapi = BelanjaSapi::where('id_chart','=',0)->with("jenissapi")->with("kandang")->get();

        $data = ([
            'data'=>$sapi
        ]);


	    return response()->json($data, 200);
    }
    public function getdatapakan($date){
        $tanggal = $date."-01";
        $tanggal_awal = date("Y-m-d", strtotime($tanggal));
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal));
	        $pakan = BelanjaPakan::with("jenissapi")->with("kandang")
                ->whereBetween('tanggal_pembelian',[$tanggal_awal, $tanggal_akhir])
                ->get();
            $data = ([
                'data'=>$pakan
            ]);
	    return response()->json($data, 200);
    }

}
