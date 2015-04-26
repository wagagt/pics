<?php

class Reasons extends \Eloquent {
	protected $fillable = array('name', 'description', 'text', 'type', 'active');


	public static function get_all_reasons($type) {
		$reasons = DB::table('reasons')
		->select('id', 'name', 'text')
		->where('type', '=', $type)
		->where('active', '=', 1)
		->orderBy('name', '=', 'id')
		->get();

		// return in simple array
		 // $results=array_map(function($item){
		 //       return (array) $item;
		 //   },$results);
	//echo"<pre>";var_dump($results);echo"</pre>";
	return $reasons;
	}
}