<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Kandang;
use App\Operasional;
use App\Http\Requests\CreateOperasionalRequest;
use App\Http\Requests\UpdateOperasionalRequest;
use Illuminate\Http\Request;



class OperasionalController extends Controller {

	/**
	 * Display a listing of operasional
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $operasional = Operasional::all();

		return view('admin.operasional.index', compact('operasional'));
	}

	/**
	 * Show the form for creating a new operasional
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

        $kandang = Kandang::pluck("nama", "id")->prepend('Please select', null);

        return view('admin.operasional.create',compact('kandang'));
	}

	/**
	 * Store a newly created operasional in storage.
	 *
     * @param CreateOperasionalRequest|Request $request
	 */
	public function store(CreateOperasionalRequest $request)
	{

		Operasional::create($request->all());

		return redirect()->route(config('quickadmin.route').'.operasional.index');
	}

	/**
	 * Show the form for editing the specified operasional.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$operasional = Operasional::find($id);


		return view('admin.operasional.edit', compact('operasional'));
	}

	/**
	 * Update the specified operasional in storage.
     * @param UpdateOperasionalRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateOperasionalRequest $request)
	{
		$operasional = Operasional::findOrFail($id);



		$operasional->update($request->all());

		return redirect()->route(config('quickadmin.route').'.operasional.index');
	}

	/**
	 * Remove the specified operasional from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Operasional::destroy($id);

		return redirect()->route(config('quickadmin.route').'.operasional.index');
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
            Operasional::destroy($toDelete);
        } else {
            Operasional::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.operasional.index');
    }

}
