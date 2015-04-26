<?php

class Category extends MoreEloquent {

	// /**
	//  * The database table used by the model.
	//  *
	//  * @var string
	//  */
	protected $table = 'categories';
	
	protected $fillable = array('title', 'description');
    
    protected $hidden = array();

}
