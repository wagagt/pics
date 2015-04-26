<?php

class Search extends MoreEloquent {

	// /**
	//  * The database table used by the model.
	//  *
	//  * @var string
	//  */
	protected $table = 'search';
	
	protected $fillable = array('id', 'title_description');
    
    protected $hidden = array();
    
    // public $timestamps = false;
  
}
