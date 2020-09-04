<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Kandang;
use App\Showroom;
use App\Http\Requests\CreateShowroomRequest;
use App\Http\Requests\UpdateShowroomRequest;
use Illuminate\Http\Request;



class ShowroomController extends Controller {

	/**
	 * Display a listing of showroom
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $showroom = Showroom::all();

		return view('admin.showroom.index', compact('showroom'));
	}

	/**
	 * Show the form for creating a new showroom
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

        $kandang = Kandang::pluck("nama", "id")->prepend('Please select', null);

        return view('admin.showroom.create',compact('kandang'));
	}

	/**
	 * Store a newly created showroom in storage.
	 *
     * @param CreateShowroomRequest|Request $request
	 */
	public function store(CreateShowroomRequest $request)
	{

		Showroom::create($request->all());

		return redirect()->route(config('quickadmin.route').'.showroom.index');
	}

	/**
	 * Show the form for editing the specified showroom.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$showroom = Showroom::find($id);


		return view('admin.showroom.edit', compact('showroom'));
	}

	/**
	 * Update the specified showroom in storage.
     * @param UpdateShowroomRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateShowroomRequest $request)
	{
		$showroom = Showroom::findOrFail($id);



		$showroom->update($request->all());

		return redirect()->route(config('quickadmin.route').'.showroom.index');
	}

	/**
	 * Remove the specified showroom from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Showroom::destroy($id);

		return redirect()->route(config('quickadmin.route').'.showroom.index');
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
            Showroom::destroy($toDelete);
        } else {
            Showroom::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.showroom.index');
    }

}
