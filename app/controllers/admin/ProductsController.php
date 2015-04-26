<?php
class ProductsController extends BaseController {


	/**
	 * Display a listing of the resource.
	 * GET /admin/products
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/products/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/products
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/products/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function status()
	{	
 		$data = Input::all();
		$new_status			=	$data['status']; 
		$product_id 		=	$data['product_id'];
		$reason_id	 		=	$data['reason_id'];
		$product = Product::find($product_id);
		$action = "Change product status [".$product->active."] -> [".$new_status."] reason_id:".$reason_id;
        
        $product->active   = $new_status;
        $product->save();

		// if change status, save ProductLogs entry
		ProductsLog::create(array(
			'product_id'	=>	$product_id, 
			'user_id' 		=>	Auth::id(),
			'reason_id' 	=>	$reason_id,
			'action' 		=> 	$action,
			'comment'		=> 	Input::get('comment')
		));

        return;
	}

	public function getInfo($product_id)
	{	
		$params 	= Input::All();
		//$product_id = $params['product_id'];
		$data = array(
			'product' 		=> 	DB::table('products')
								->select ('products.title', 'products.description', 'products.price', 'products.latitude', 'products.longitude', 'products.ip', 'products.active as product_active'
									, 'products.created_at as product_created_at', 'products.updated_at', 'products.comment'
									,'categories.title as category_title'
									,'users.name', 'users.first_name', 'users.last_name', 'users.email', 'users.gender', 'users.picture', 'users.active as user_active', 'users.created_at  as user_created_at'
									,'currency.symbol', 'currency.iso_currency', 'currency.country', 'currency.iso_country')
								->join('categories', 'products.category_id', '=', 'categories.id')
								->join('users', 'products.user_id', '=', 'users.id')
								->join('currency', 'products.currency_id', '=', 'currency.id')
								->where ('products.id', '=', $product_id)
								->get(),
			'images' 		=>	DB::table('images')
								->where ('product_id', '=', $product_id)
								->get(),
			'product_log'	=>	DB::table('products_logs')
								->select ('products_logs.product_id', 'products_logs.user_id', 'products_logs.reason_id', 'products_logs.action', 'products_logs.comment as log_comment', 'products_logs.created_at as product_log_created_at'
									,'reasons.name as reason_name')
								->join('reasons', 'products_logs.reason_id', '=', 'reasons.id')
								->where ('product_id', '=', $product_id)
								->orderBy('products_logs.created_at', 'desc')
								->get(),
		);
		usleep(10000);
        return json_encode($data);
	}

}