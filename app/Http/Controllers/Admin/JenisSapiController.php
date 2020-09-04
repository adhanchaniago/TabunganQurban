<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\JenisSapi;
use App\Http\Requests\CreateJenisSapiRequest;
use App\Http\Requests\UpdateJenisSapiRequest;
use Illuminate\Http\Request;



class JenisSapiController extends Controller {

	/**
	 * Display a listing of jenissapi
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jenissapi = JenisSapi::all();

		return view('admin.jenissapi.index', compact('jenissapi'));
	}

	/**
	 * Show the form for creating a new jenissapi
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jenissapi.create');
	}

	/**
	 * Store a newly created jenissapi in storage.
	 *
     * @param CreateJenisSapiRequest|Request $request
	 */
	public function store(CreateJenisSapiRequest $request)
	{
	    
		JenisSapi::create($request->all());

		return redirect()->route(config('quickadmin.route').'.jenissapi.index');
	}

	/**
	 * Show the form for editing the specified jenissapi.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jenissapi = JenisSapi::find($id);
	    
	    
		return view('admin.jenissapi.edit', compact('jenissapi'));
	}

	/**
	 * Update the specified jenissapi in storage.
     * @param UpdateJenisSapiRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJenisSapiRequest $request)
	{
		$jenissapi = JenisSapi::findOrFail($id);

        

		$jenissapi->update($request->all());

		return redirect()->route(config('quickadmin.route').'.jenissapi.index');
	}

	/**
	 * Remove the specified jenissapi from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		JenisSapi::destroy($id);

		return redirect()->route(config('quickadmin.route').'.jenissapi.index');
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
            JenisSapi::destroy($toDelete);
        } else {
            JenisSapi::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.jenissapi.index');
    }

}
