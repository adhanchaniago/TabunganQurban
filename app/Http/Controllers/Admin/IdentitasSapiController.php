<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\IdentitasSapi;
use App\Http\Requests\CreateIdentitasSapiRequest;
use App\Http\Requests\UpdateIdentitasSapiRequest;
use Illuminate\Http\Request;

use App\BelanjaSapi;


class IdentitasSapiController extends Controller {

	/**
	 * Display a listing of identitassapi
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $identitassapi = IdentitasSapi::with("belanjasapi")->get();

		return view('admin.identitassapi.index', compact('identitassapi'));
	}

	/**
	 * Show the form for creating a new identitassapi
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $belanjasapi = BelanjaSapi::pluck("tanggal_pembelian", "id")->prepend('Please select', null);

	    
	    return view('admin.identitassapi.create', compact("belanjasapi"));
	}

	/**
	 * Store a newly created identitassapi in storage.
	 *
     * @param CreateIdentitasSapiRequest|Request $request
	 */
	public function store(CreateIdentitasSapiRequest $request)
	{
	    
		IdentitasSapi::create($request->all());

		return redirect()->route(config('quickadmin.route').'.identitassapi.index');
	}

	/**
	 * Show the form for editing the specified identitassapi.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$identitassapi = IdentitasSapi::find($id);
	    $belanjasapi = BelanjaSapi::pluck("tanggal_pembelian", "id")->prepend('Please select', null);

	    
		return view('admin.identitassapi.edit', compact('identitassapi', "belanjasapi"));
	}

	/**
	 * Update the specified identitassapi in storage.
     * @param UpdateIdentitasSapiRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateIdentitasSapiRequest $request)
	{
		$identitassapi = IdentitasSapi::findOrFail($id);

        

		$identitassapi->update($request->all());

		return redirect()->route(config('quickadmin.route').'.identitassapi.index');
	}

	/**
	 * Remove the specified identitassapi from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		IdentitasSapi::destroy($id);

		return redirect()->route(config('quickadmin.route').'.identitassapi.index');
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
            IdentitasSapi::destroy($toDelete);
        } else {
            IdentitasSapi::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.identitassapi.index');
    }

}
