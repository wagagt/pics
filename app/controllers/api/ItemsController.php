<?php

class ItemsController extends \BaseController {

    public function __construct() {
        $this->beforeFilter('coordinates', array('only' => array('index','store','update')) );
        $this->beforeFilter('token', array('on' => array('store','update','destroy')) );
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$products = Product::get_nearby_products();
		return Response::json($products);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$id = Product::create_api_product();
        return Response::json($id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$product = Product::get_api_product($id);

		return Response::json($product);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$product = Product::delete_api_product($id);
		return Response::json($product);
	}


}
