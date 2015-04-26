<?php

class ApiTools {

    /**
     * Validates latitude from request
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @return bool
     */
    public static function validate_latitude() {
        $latitude  = Request::header("latitude"); // Input::get('latitude');
        $validator = Validator::make(
            array('latitude' => $latitude),
            array('latitude' => array('required','regex:/^-?(90\.0{0,7}|[0-8]?[0-9]\.\d{6,8})$/'))
        );
        if ($validator->fails()) {
            ApiTools::log(array($latitude,$validator->errors()),'validate_latitude');    
            App::abort(400, 'IllegalOrMissingLatitudeValue');
        }
        Config::set('latitude', $latitude);
    }
    
    /**
     * Validates longitude from request
     * @author Attakinsky <jblanco@xyznetworkinc.com>
     * @return bool
     */
    public static function validate_longitude() {
        $longitude  = Request::header("longitude"); //Input::get('longitude');
        $validator = Validator::make(
            array('longitude' => $longitude),
            array('longitude' => array('required','regex:/^-?(180\.0{0,7}|[0-9]?[0-9]\.\d{6,8}|[0-8][0-9]\.\d{6,8})$/'))
        );
        if ($validator->fails()) {
            ApiTools::log(array($longitude,$validator->errors()),'validate_longitude');
            App::abort(400, 'IllegalOrMissingLongitudeValue');
        }
        Config::set('longitude', $longitude);
    }
    
    public static function check_coordinates() {
        self::validate_latitude();
        self::validate_longitude();
    }
    
    public static function get_country($latitude, $longitude, $name = 'long') {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&language=es';
        $json = @file_get_contents($url);
        $geoData=json_decode($json);
        
        foreach($geoData->results[1]->address_components as $addressComponent) {
            if(in_array('country', $addressComponent->types)) {
                $long_name  = $addressComponent->long_name;  // Guatemala
                $short_name = $addressComponent->short_name; // GT
            }
        }
        
        return ($name=='long') ? $long_name : $short_name;
    }
    
    public static function create_path($path) {
        $folders = explode('/',trim($path,'/'));
        $folder_name = base_path();
        
        foreach($folders as $folder) {
            
            $folder_name .= '/' . $folder;
            
            if(!file_exists($folder_name)) {
                mkdir($folder_name, 0775);
            }
        }
        
    }
    
    public static function check_headers () {
        
        $header_name = Config::get('app.request_header_name');
        $header = Request::header($header_name);
        
        if(!$header ) return false;
        
        if($header != Config::get('app.request_header_value')) return false;
        
        return true;
    }
    
    public static function str_rot($s, $n = 13) {
        static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
        $n = (int)$n % 26;
        if (!$n) return $s;
        if ($n < 0) $n += 26;
        if ($n == 13) return str_rot13($s);
        $rep = substr($letters, $n * 2) . substr($letters, 0, $n * 2);
        return strtr($s, $letters, $rep);
    }
    
	/**
	 * Obtiene el public_key para un token
	 * @param string $fbid id de facebook del usuario
	 * @return string md5 rotado
	 */
	public static function get_public_key($fbid) {
		
		$user_agent = Request::server('HTTP_USER_AGENT');
		
		$simple_chain = $fbid . ' at ' . $user_agent;
		
		$md5_chain = md5($simple_chain);
		
		$rotated_chain = ApiTools::str_rot($md5_chain,15);
		
		return $rotated_chain;
		
	}
    
    public static function log($array = array(),$label=false) {
        if(App::environment()=='local'){
            $monolog = Log::getMonolog();
            // Choose FirePHP as the log handler
            $monolog->pushHandler(new \Monolog\Handler\FirePHPHandler());
            // Start logging
            $label = $label ? $label : date('H:i:s');
            $monolog->addInfo($label, $array);
        }
    }
    
}
