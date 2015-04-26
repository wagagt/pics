<?php

class Image extends MoreEloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'images';
	
	protected $fillable = array('product_id', 'filename','thumbnail');
    
    protected $hidden = array();
    
    public function author()
    {
        return $this->belongsTo('Product', 'id');
    }

}
