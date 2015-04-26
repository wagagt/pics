<?php

class UserController extends \BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response JSON
	 */
	public function show($id) {

		$user = User::get_api_user($id);

		return Response::json($user);
	}

	/**
	 * Update or create the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response JSON
	 */
	public function store() {
		
		$check_user = User::store();
		
		return Response::json($check_user);
	}
}


