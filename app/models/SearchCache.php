<?php

class SearchCache extends MoreEloquent {
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'search_cache';
	

    public static function get($key, $page) {
        return DB::table('search_cache')
            ->where('key','=',$key)
            ->where('page','=',$page)
            ->first();
    }
    
    public static function put($key, $page, $value) {
        $minutes = Config::get('app.cache_minutes');
		$expires = gmdate('Y-m-d H:i:s',time() + ((int)$minutes * 60));
        DB::table('search_cache')->insert(
            array(
                'key' => $key,
                'page' => $page,
                'value' => $value,
                'expiration' => $expires,
            )
        );
    }
    
}