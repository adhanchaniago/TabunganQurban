<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Kandang;
use App\Http\Requests\CreateKandangRequest;
use App\Http\Requests\UpdateKandangRequest;
use Illuminate\Http\Request;



class KandangController extends Controller {

	/**
	 * Display a listing of kandang
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $kandang = Kandang::all();

		return view('admin.kandang.index', compact('kandang'));
	}

	/**
	 * Show the form for creating a new kandang
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.kandang.create');
	}

	/**
	 * Store a newly created kandang in storage.
	 *
     * @param CreateKandangRequest|Request $request
	 */
	public function store(CreateKandangRequest $request)
	{
	    
		Kandang::create($request->all());

		return redirect()->route(config('quickadmin.route').'.kandang.index');
	}

	/**
	 * Show the form for editing the specified kandang.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$kandang = Kandang::find($id);
	    
	    
		return view('admin.kandang.edit', compact('kandang'));
	}

	/**
	 * Update the specified kandang in storage.
     * @param UpdateKandangRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateKandangRequest $request)
	{
		$kandang = Kandang::findOrFail($id);

        

		$kandang->update($request->all());

		return redirect()->route(config('quickadmin.route').'.kandang.index');
	}

	/**
	 * Remove the specified kandang from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Kandang::destroy($id);

		return redirect()->route(config('quickadmin.route').'.kandang.index');
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
            Kandang::destroy($toDelete);
        } else {
            Kandang::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.kandang.index');
    }

}
