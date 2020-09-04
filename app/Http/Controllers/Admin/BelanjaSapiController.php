<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BelanjaSapi;
use App\JenisSapi;
use App\Kandang;
use App\Http\Requests\CreateBelanjaSapiRequest;
use App\Http\Requests\UpdateBelanjaSapiRequest;
use Illuminate\Http\Request;
use App\Growth;



class BelanjaSapiController extends Controller {

	/**
	 * Display a listing of belanjasapi
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $belanjasapi = BelanjaSapi::with("jenissapi")->get();

		return view('admin.belanjasapi.index', compact('belanjasapi'));
	}

	/**
	 * Show the form for creating a new belanjasapi
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

        $jenissapi = JenisSapi::pluck("jenis_sapi", "id")->prepend('Please select', null);
        $kandang = Kandang::pluck("nama", "id")->prepend('Please select', null);

        return view('admin.belanjasapi.create', compact('jenissapi','kandang'));
	}

	/**
	 * Store a newly created belanjasapi in storage.
	 *
     * @param CreateBelanjaSapiRequest|Request $request
	 */
	public function store(CreateBelanjaSapiRequest $request)
	{
        $post = new BelanjaSapi();
        $post->eartag = $request->eartag;
        $post->jenis_sapi = $request->jenis_sapi;
        $post->kandang = $request->kandang;
        $post->bobot_sapi = $request->bobot_sapi;
        $post->harga_p_kg = $request->harga_p_kg;
        $post->harga_p_ekor = $request->harga_p_ekor;
        $post->tanggal_pembelian = $request->tanggal_pembelian;
        $post->save();

        $identitassapi = new Growth();
        $identitassapi->belanjasapi_id = $post->id;
        $identitassapi->bobot = $request->bobot_sapi;
        $identitassapi->tanggal_cek = $request->tanggal_pembelian;
        $identitassapi->catatan ="Awal Masuk";
//        return $post->id;
//        return $request;

//		BelanjaSapi::create($request->all());
//
		return redirect()->route(config('quickadmin.route').'.belanjasapi.index');
	}

	/**
	 * Show the form for editing the specified belanjasapi.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$belanjasapi = BelanjaSapi::find($id);


		return view('admin.belanjasapi.edit', compact('belanjasapi'));
	}

	/**
	 * Update the specified belanjasapi in storage.
     * @param UpdateBelanjaSapiRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBelanjaSapiRequest $request)
	{
		$belanjasapi = BelanjaSapi::findOrFail($id);



		$belanjasapi->update($request->all());

		return redirect()->route(config('quickadmin.route').'.belanjasapi.index');
	}

	/**
	 * Remove the specified belanjasapi from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		BelanjaSapi::destroy($id);

		return redirect()->route(config('quickadmin.route').'.belanjasapi.index');
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
            BelanjaSapi::destroy($toDelete);
        } else {
            BelanjaSapi::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.belanjasapi.index');
    }

}
