<?php

class MoreEloquent extends Eloquent {

    public static function find_active($id,$child) {
        
        
        ApiTools::log(array($child->getTable()),'User::find_active('.$id.')');
    }

}
