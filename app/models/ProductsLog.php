<?php

class ProductsLog extends \Eloquent {
	protected $fillable = array('product_id', 'user_id', 'reason_id','action', 'comment');
}