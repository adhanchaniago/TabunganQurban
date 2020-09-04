<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BelanjaPakan;
use App\Kandang;
use App\JenisSapi;
use App\Http\Requests\CreateBelanjaPakanRequest;
use App\Http\Requests\UpdateBelanjaPakanRequest;
use Illuminate\Http\Request;



class BelanjaPakanController extends Controller {

	/**
	 * Display a listing of belanjapakan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $belanjapakan = BelanjaPakan::all();

		return view('admin.belanjapakan.index', compact('belanjapakan'));
	}

	/**
	 * Show the form for creating a new belanjapakan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
        $jenissapi = JenisSapi::pluck("jenis_sapi", "id")->prepend('Please select', null);

        $kandang = Kandang::pluck("nama", "id")->prepend('Please select', null);

        return view('admin.belanjapakan.create', compact('kandang','jenissapi'));
	}

	/**
	 * Store a newly created belanjapakan in storage.
	 *
     * @param CreateBelanjaPakanRequest|Request $request
	 */
	public function store(CreateBelanjaPakanRequest $request)
	{

		BelanjaPakan::create($request->all());

		return redirect()->route(config('quickadmin.route').'.belanjapakan.index');
	}

	/**
	 * Show the form for editing the specified belanjapakan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$belanjapakan = BelanjaPakan::find($id);


		return view('admin.belanjapakan.edit', compact('belanjapakan'));
	}

	/**
	 * Update the specified belanjapakan in storage.
     * @param UpdateBelanjaPakanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBelanjaPakanRequest $request)
	{
		$belanjapakan = BelanjaPakan::findOrFail($id);



		$belanjapakan->update($request->all());

		return redirect()->route(config('quickadmin.route').'.belanjapakan.index');
	}

	/**
	 * Remove the specified belanjapakan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		BelanjaPakan::destroy($id);

		return redirect()->route(config('quickadmin.route').'.belanjapakan.index');
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
            BelanjaPakan::destroy($toDelete);
        } else {
            BelanjaPakan::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.belanjapakan.index');
    }

}
