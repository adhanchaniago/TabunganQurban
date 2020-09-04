<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\AnggaranPakan;
use App\Http\Requests\CreateAnggaranPakanRequest;
use App\Http\Requests\UpdateAnggaranPakanRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;



class AnggaranPakanController extends Controller {

	/**
	 * Display a listing of anggaranpakan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $anggaranpakan = AnggaranPakan::all();

		return view('admin.anggaranpakan.index', compact('anggaranpakan'));
	}

	/**
	 * Show the form for creating a new anggaranpakan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{


	    return view('admin.anggaranpakan.create');
	}

	/**
	 * Store a newly created anggaranpakan in storage.
	 *
     * @param CreateAnggaranPakanRequest|Request $request
	 */
	public function store(CreateAnggaranPakanRequest $request)
	{

        $tanggal = $request->tanggal_awal."-01";
        $tanggal_awal = date("Y-m-d", strtotime($tanggal));
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal));


        $store = new AnggaranPakan();
        $store->tanggal_awal = $tanggal_awal;
        $store->tanggal_akhir = $tanggal_akhir;
        $store->jumlah_anggaran = $request->jumlah_anggaran;
        $store->save();
//        return $tanggal." ".$tanggal_akhir;


//		AnggaranPakan::create($request->all());

		return redirect()->route(config('quickadmin.route').'.anggaranpakan.index');
	}

	/**
	 * Show the form for editing the specified anggaranpakan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$anggaranpakan = AnggaranPakan::find($id);


		return view('admin.anggaranpakan.edit', compact('anggaranpakan'));
	}

	/**
	 * Update the specified anggaranpakan in storage.
     * @param UpdateAnggaranPakanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateAnggaranPakanRequest $request)
	{
		$anggaranpakan = AnggaranPakan::findOrFail($id);



		$anggaranpakan->update($request->all());

		return redirect()->route(config('quickadmin.route').'.anggaranpakan.index');
	}

	/**
	 * Remove the specified anggaranpakan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		AnggaranPakan::destroy($id);

		return redirect()->route(config('quickadmin.route').'.anggaranpakan.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            AnggaranPakan::destroy($toDelete);
        } else {
            AnggaranPakan::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.anggaranpakan.index');
    }

}
