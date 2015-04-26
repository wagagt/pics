<?php

class Currency extends MoreEloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'currency';
	
	protected $fillable = array('country', 'symbol', 'iso_currency', 'iso_country');
    
    protected $hidden = array();

}
