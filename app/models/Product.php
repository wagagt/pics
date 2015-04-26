<?php

class Product extends MoreEloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	
	protected $fillable = array('user_id', 'category_id', 'currency_id', 'title', 'description', 'price', 'latitude', 'longitude', 'iso_country', 'country', 'ip');
    
    protected $hidden = array();
    
    public function images()
    {
        return $this->hasMany('Image','product_id');
    }
    
    /**
     * Devuelve los productos a partir de los iD cacheados por una búsqueda
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @param string $key Identificador de la búsqueda
     * @param integer @page Número d epágina a buscar
     * @return Product
     */
    public static function get_cached_products($key,$page) {
        $cached_ids = SearchCache::get($key,$page);
        
        if (!$cached_ids) App::abort(400, 'CachedSearchExpired');
        /*$products = Product::whereRaw("id IN ({$cached_ids->value})")->get();
        foreach($products as $i => $product) {
            $products[$i]->images = $product->images;
        }*/
        $cached_ids = explode(',',$cached_ids->value);
        //die(var_dump($cached_ids));
        $products = DB::table('products as p')
            ->select('p.id','p.title','c.symbol','p.price','i.thumbnail as main_image')
            ->join('images as i','i.product_id','=','p.id')
            ->join('currency as c','c.id','=','p.currency_id')
            ->whereIn('p.id',$cached_ids)
            ->groupBy('i.product_id')
            ->get();
        //ApiTools::log(array($products),"get_cached_products({$key},{$page})");
        return $products;
    }
    
    /**
     * Rules for a new product
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @return array
     */
    public static function get_create_rules() {
        return array(
			'category_id' => 'required|integer',
			'currency_id' => 'required|integer',
			'title'       => 'required',
			'description' => 'required',
			'price'       => 'required|numeric',
			'country'     => 'required',
			'iso_country' => 'required',
			'ip'          => 'required',
			'picture'     => 'required|image|mimes:jpeg',
			'thumbnail'   => 'required|image|mimes:jpeg',
		);
    }
    
    /**
     * Almacena una imagen enviada por el usuario con su thumbnail
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @param integer $user_id ID del usuario
     * @param integer $category_id ID de la categoría
     * @return array 
     */
    public static function upload_new_image($user_id, $category_id) {
        try {
            $time =str_replace(array('.',' ',','),'',microtime());
            $folder_path = base_path() . '/';
            $image_path =  '/products/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $category_id . '/' . $user_id . '/';
            ApiTools::create_path($image_path);
            // Imagen principal
            $file = Input::file('picture');
            $filename = $time . '.jpg';
            $file->move(base_path().$image_path, $filename);
            // Thumbnail 
            $file = Input::file('thumbnail');
            $thumbnail = $time . '-thumb.jpg';
            $file->move(base_path().$image_path, $thumbnail);
            
            return array(
                'image' => $image_path . $filename,
                'thumb' => $image_path . $thumbnail,
            );
        } catch (Exception $e) {
            App::abort(400, $e->getMessage());
        }
    }
    
    /**
     * Crea un registro de producto a partir de un push en la API
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @return Product
     */
    public static function create_api_product() {
        
        $latitude = Config::get('latitude');
        $longitude = Config::get('longitude');
        
        // Valida el post de producto
        $product_data = Input::all();
        $rules = self::get_create_rules(); 
        $validator = Validator::make($product_data, $rules);
        if($validator->fails()) App::abort(400, $validator->errors()); 
        
        // Upload de los archivos
        $user_id = Config::get('user_id');
        $uploaded_image = self::upload_new_image($user_id,$product_data['category_id']);
        
        // Crea el nuevo producto y guarda su imagen
        $product_data['latitude']  = $latitude;
        $product_data['longitude'] = $longitude;
        $product_data['user_id']   = $user_id;
        $product = Product::create($product_data);
        $image   = Image::create(array(
            'product_id' => $product->id,
            'filename' => $uploaded_image['image'],
            'thumbnail' => $uploaded_image['thumb'],
        ));
        $product->image = $image;
        return array($product);
    }
    
    /**
     * Obtiene los id de productos cercanos al usuario
     * y los almacena en el caché de búsqueda
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @param integer $category ID de la categoría
     * @param string $term Texto a buscar con fulltext-seach
     * return array
     */
    public static function get_nearby_products($category = false, $term = false) {
        
        $latitude = Config::get('latitude');
        $longitude = Config::get('longitude');

        $earth_mean_radius = Config::get('app.earth_mean_radius');
        $search_radius = Config::get('app.search_radius');
        
        // first-cut bounding box (in degrees)
        $maxLatitude = $latitude + rad2deg($search_radius/$earth_mean_radius);
        $minLatitude = $latitude - rad2deg($search_radius/$earth_mean_radius);
        // compensate for degrees longitude getting smaller with increasing latitude
        $maxLongitude = $longitude + rad2deg($search_radius/$earth_mean_radius/cos(deg2rad($latitude)));
        $minLongitude = $longitude - rad2deg($search_radius/$earth_mean_radius/cos(deg2rad($latitude)));
        
        $query = DB::table('search')
            ->where('latitude', '>=',$minLatitude)
            ->where('latitude', '<=',$maxLatitude)
            ->where('longitude','>=',$minLongitude)
            ->where('longitude','<=',$maxLongitude);
            // ->limit();
        if($category) {
            $query = $query->where('category_id', '=', $category);
        }
        if($term) {
            // http://creative-punch.net/2013/12/implementing-laravel-4-full-text-search/
            $query = $query->whereRaw("MATCH(title_description) AGAINST(? IN BOOLEAN MODE)", array($term));
        }
        $all_products_ids = $query->lists('id');
        if(!$all_products_ids) App::abort(400, 'NoResultsFound'); 
        
        $sliced_products_ids = array_chunk($all_products_ids,10);
        $pages = count($sliced_products_ids);
        $time = str_replace(array('.',' '),'',microtime());
        $search_key = sha1('search_cache_hash_'.time().$time);
        for($i=1; $i<=$pages; $i++) {
            $ids_string = implode(',',$sliced_products_ids[$i-1]);
            SearchCache::put($search_key,$i,$ids_string);
        }
        
        ApiTools::log(array($maxLatitude,$minLatitude,$maxLongitude,$minLongitude,$pages,$sliced_products_ids),'Product::get_nearby_products('.$category.','.$term.')');
        return array('search_key'=>$search_key,'pages'=>$pages);
    }
    
    /**
     * Gets a single product based on requested ID
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @param int $id Product id
     * @return array Response
     */
    public static function get_api_product($id) {
		$product = DB::table('products')
            ->select(
                'products.id', 'products.title', 'products.description', 'products.price', 'products.latitude', 'products.longitude', 
                'categories.title as category',
                'currency.symbol',
                'users.fbid', 'users.name', 'users.first_name', 'users.last_name', 'users.picture'//,
            )
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('currency', 'currency.id', '=', 'products.currency_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('products.id',$id)
            ->where('products.active','>',0)
            ->first();
            
        $product->images = Image::where('product_id', '=', $id)->get(array(DB::raw('CONCAT("'.Config::get('app.url').'",images.filename) as filename')));
        
		ApiTools::log(array($product),'Product::get_product('.$id.')');
		
		if(!$product) return array('status_code' => 800, 'errors' => array('ResourceNotFound'));
		
		//return array('status_code' => 200, 'data' => $product);
        return array('items'=>$product);
        
    }
    
    /**
     * Change status "active" to 0, for matching product
     * Product user_id must be same as active token user
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @param int $id Product id
     * @return array Response
     */
    public static function delete_api_product($id) {
        $token = Input::get('token');
        
        $product = DB::table('products')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->join('tokens','tokens.fbid','=','users.fbid')
            ->where('products.id',$id)
            ->where('tokens.token',$token)
            ->update(array('products.active'=>0));
        
        if(!$product) return array('status_code' => 800, 'errors' => array('ResourceNotFound'));
        
        return array('status_code' => 200, 'data' => $product);    
    }

    public static function get_products($status){
    	$data = DB::table ('products')
	    ->select ('products.id', 'users.name', 'categories.title', 'currency.country', 'currency.symbol', 'products.price', 
	        DB::raw("COALESCE(images.filename,'http://placehold.it/150x100') as filename "), 
	        DB::raw('count(images.product_id) as total_images'), 'products.title', 'products.description', 'products.active' )
	    ->join ('users', 'products.user_id', '=', 'users.id')
	    ->join ('categories', 'products.category_id', '=', 'categories.id')
	    ->join ('currency', 'products.currency_id', '=', 'currency.id')
	    ->leftjoin ('images', 'products.id', '=', 'images.product_id')
	    ->where('products.active', '=', $status)
	    ->groupBy('products.id')
	    ->orderBy('products.created_at', 'desc')
	    ->paginate(50);
    	return $data;

    }

}
