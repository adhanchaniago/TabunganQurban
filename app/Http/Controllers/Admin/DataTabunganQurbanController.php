<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\DataTabunganQurban;
use App\Http\Requests\CreateDataTabunganQurbanRequest;
use App\Http\Requests\UpdateDataTabunganQurbanRequest;
use Illuminate\Http\Request;



class DataTabunganQurbanController extends Controller {

	/**
	 * Display a listing of datatabunganqurban
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $datatabunganqurban = DataTabunganQurban::all();

		return view('admin.datatabunganqurban.index', compact('datatabunganqurban'));
	}

	/**
	 * Show the form for creating a new datatabunganqurban
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.datatabunganqurban.create');
	}

	/**
	 * Store a newly created datatabunganqurban in storage.
	 *
     * @param CreateDataTabunganQurbanRequest|Request $request
	 */
	public function store(CreateDataTabunganQurbanRequest $request)
	{
	    
		DataTabunganQurban::create($request->all());

		return redirect()->route(config('quickadmin.route').'.datatabunganqurban.index');
	}

	/**
	 * Show the form for editing the specified datatabunganqurban.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$datatabunganqurban = DataTabunganQurban::find($id);
	    
	    
		return view('admin.datatabunganqurban.edit', compact('datatabunganqurban'));
	}

	/**
	 * Update the specified datatabunganqurban in storage.
     * @param UpdateDataTabunganQurbanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDataTabunganQurbanRequest $request)
	{
		$datatabunganqurban = DataTabunganQurban::findOrFail($id);

        

		$datatabunganqurban->update($request->all());

		return redirect()->route(config('quickadmin.route').'.datatabunganqurban.index');
	}

	/**
	 * Remove the specified datatabunganqurban from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		DataTabunganQurban::destroy($id);

		return redirect()->route(config('quickadmin.route').'.datatabunganqurban.index');
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
            DataTabunganQurban::destroy($toDelete);
        } else {
            DataTabunganQurban::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.datatabunganqurban.index');
    }

}
