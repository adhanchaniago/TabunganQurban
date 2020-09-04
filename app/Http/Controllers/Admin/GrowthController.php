<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Growth;
use App\Http\Requests\CreateGrowthRequest;
use App\Http\Requests\UpdateGrowthRequest;
use Illuminate\Http\Request;

use App\BelanjaSapi;


class GrowthController extends Controller {

	/**
	 * Display a listing of growth
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $growth = Growth::with("belanjasapi")->get();

		return view('admin.growth.index', compact('growth'));
	}

	/**
	 * Show the form for creating a new growth
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $belanjasapi = BelanjaSapi::pluck("eartag", "id")->prepend('Please select', null);

	    
	    return view('admin.growth.create', compact("belanjasapi"));
	}

	/**
	 * Store a newly created growth in storage.
	 *
     * @param CreateGrowthRequest|Request $request
	 */
	public function store(CreateGrowthRequest $request)
	{
	    
		Growth::create($request->all());

		return redirect()->route(config('quickadmin.route').'.growth.index');
	}

	/**
	 * Show the form for editing the specified growth.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$growth = Growth::find($id);
	    $belanjasapi = BelanjaSapi::pluck("eartag", "id")->prepend('Please select', null);

	    
		return view('admin.growth.edit', compact('growth', "belanjasapi"));
	}

	/**
	 * Update the specified growth in storage.
     * @param UpdateGrowthRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGrowthRequest $request)
	{
		$growth = Growth::findOrFail($id);

        

		$growth->update($request->all());

		return redirect()->route(config('quickadmin.route').'.growth.index');
	}

	/**
	 * Remove the specified growth from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Growth::destroy($id);

		return redirect()->route(config('quickadmin.route').'.growth.index');
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
            Growth::destroy($toDelete);
        } else {
            Growth::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.growth.index');
    }

}
