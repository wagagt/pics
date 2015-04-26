<?php

class SearchController extends \BaseController {
    
    public function index($key,$page) {
        $products = Product::get_cached_products($key,$page);
        return Response::json(array('items'=>$products));
    }

    public function category($category_id) {
        $products = Product::get_nearby_products($category_id);
        return Response::json(array('items'=>$products));
	}

    public function term($term) {
        $products = Product::get_nearby_products(false,$term);
        return Response::json(array('items'=>$products));
	}
}


