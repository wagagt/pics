<?php

class AdminsController extends \BaseController {

	/**
	 * Display a listing of admins
	 *
	 * @return Response
	 */
	public function index()
	{
		$data= array(
			'admins' 	=> Admin::all(),
			'rols'		=> Admin::get_enum_values('rol')
		);
		//myDump($data,1,1);
		return View::make('admin.admins.index')->with('data',$data);
	}

	/**
	 * Show the form for creating a new admin
	 *
	 * @return Response
	 */
	public function create()
	{
		$data= array(
			'admins' 	=> Admin::all(),
			'rols'		=> Admin::get_enum_values('rol')
		);
		return View::make('admin.admins.create')->with('data',$data);
	}

	/**
	 * Store a newly created admin in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$validator = Admin::validate($data);
		//myDump($validator,1,1);	

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['password'] = Hash::make($data['password']);
		Admin::create($data);

		return Redirect::route('admins.index');
	}

	/**
	 * Display the specified admin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$admin = Admin::findOrFail($id);

		return View::make('admin.admins.show', compact('admin'));
	}

	/**
	 * Show the form for editing the specified admin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$admin = Admin::find($id);

		return View::make('admin.admins.edit', compact('admin'));
	}

	/**
	 * Update the specified admin in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		//myDump($data,1,1);	

		$admin = Admin::findOrFail($id);

		$validator = Validator::make($data, Admin::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['status'] = ( isset($data['status']) ) ? 1 : 0; 
		$admin->update($data);

		return Redirect::route('admins.index');
	}

	/**
	 * Remove the specified admin from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Admin::destroy($id);

		return Redirect::route('admins.index');
	}

}
