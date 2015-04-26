<?php

class Token extends MoreEloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tokens';
	
	protected $fillable = array('public_key', 'token', 'expires');

	public static function check($token) {
		$now = gmdate('Y-m-d H:i:s',time());

		$token = Request::header("API_KEY");
		/*$headers = getallheaders();
		if(!$input_token && isset($headers['API_KEY'])) {
			$input_token = $headers['API_KEY'];
		}*/
		if(!$token) App::abort(401, 'NoTokenProvided');
		
		$token_data = DB::table('tokens')
			->where('token','=',$token)
			->where('expires','>=',$now)
			->first();
		
		if(!$token_data) App::abort(401, 'SessionExpired');
		//if(!$token_data) {
$token_data = Token::find(1);
		// }
		
		$public_key = ApiTools::get_public_key($token_data->fbid);
		ApiTools::log(array($now,$token_data,$public_key),'Token::check('.$token.')');
		Config::set('token', $token);
		Config::set('fbid', $token_data->fbid);
		$user_id = User::where('fbid',$token_data->fbid)->pluck('id');
		Config::set('user_id', $user_id);
return true;		
		if($public_key!=$token_data->public_key) App::abort(401, 'AuthenticationFailed');
	}
	
	public static function search_token($public_key) {
		$now = gmdate('Y-m-d H:i:s',time());

		$token_data = DB::table('tokens')
			->where('public_key','=',$public_key)
			->where('expires','>=',$now)
			->first();

		// ApiTools::log(array($public_key,$now,$token_data),'search_token');
		return $token_data;
	}

	/**
	 * Crea o recupera el token para un usuario
	 * @param User $user Objeto con la data del usuario
	 * @return string Token para verificación con la App
	 */
	public static function fetch($user) {
		
		$public_key = ApiTools::get_public_key($user->fbid);
		
		$token_data = self::search_token($public_key);

		if($token_data) return $token_data;

		$token = self::generate($public_key);
		$hours = Config::get('app.token_hours');
		$expires = gmdate('Y-m-d H:i:s',time() + ((int)$hours * 60 * 60));
		
		$token_data = new Token();
		$token_data->fbid = $user->fbid;
		$token_data->public_key = $public_key;
		$token_data->token = $token;
		$token_data->expires = $expires;
		$token_data->save();
		
		return $token_data;
	}
	
	/**
	 * Genera un token basado en la $public_key
	 * @param string @public_key clave generada apra el usuario
	 * @return string Token para verificación con la App
	 */
	public static function generate($public_key) {
		
		$simple_chain = $public_key . Config::get('app.hash_pepper');
		
		$token = ApiTools::str_rot( md5($simple_chain), 12) . ApiTools::str_rot(md5(microtime(true)),7);
		
		return $token;
	}
	


}
