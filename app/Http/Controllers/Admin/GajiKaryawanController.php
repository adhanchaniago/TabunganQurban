<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\GajiKaryawan;
use App\Kandang;
use App\Http\Requests\CreateGajiKaryawanRequest;
use App\Http\Requests\UpdateGajiKaryawanRequest;
use Illuminate\Http\Request;



class GajiKaryawanController extends Controller {

	/**
	 * Display a listing of gajikaryawan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $gajikaryawan = GajiKaryawan::all();

		return view('admin.gajikaryawan.index', compact('gajikaryawan'));
	}

	/**
	 * Show the form for creating a new gajikaryawan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
        $kandang = Kandang::pluck("nama", "id")->prepend('Please select', null);


        return view('admin.gajikaryawan.create', compact('kandang'));
	}

	/**
	 * Store a newly created gajikaryawan in storage.
	 *
     * @param CreateGajiKaryawanRequest|Request $request
	 */
	public function store(CreateGajiKaryawanRequest $request)
	{

		GajiKaryawan::create($request->all());

		return redirect()->route(config('quickadmin.route').'.gajikaryawan.index');
	}

	/**
	 * Show the form for editing the specified gajikaryawan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$gajikaryawan = GajiKaryawan::find($id);


		return view('admin.gajikaryawan.edit', compact('gajikaryawan'));
	}

	/**
	 * Update the specified gajikaryawan in storage.
     * @param UpdateGajiKaryawanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGajiKaryawanRequest $request)
	{
		$gajikaryawan = GajiKaryawan::findOrFail($id);



		$gajikaryawan->update($request->all());

		return redirect()->route(config('quickadmin.route').'.gajikaryawan.index');
	}

	/**
	 * Remove the specified gajikaryawan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		GajiKaryawan::destroy($id);

		return redirect()->route(config('quickadmin.route').'.gajikaryawan.index');
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
            GajiKaryawan::destroy($toDelete);
        } else {
            GajiKaryawan::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.gajikaryawan.index');
    }

}
