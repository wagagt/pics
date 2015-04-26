<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	protected $fillable = array('fbid', 'name', 'first_name', 'last_name', 'email', 'gender', 'picture');

	protected $hidden = array('comment');
	
	public static function get_api_user($id) {
		
		$user = User::find($id);
		ApiTools::log(array($user),'User::get_user('.$id.')');
		
		if(!$user) return array('status_code' => 800, 'errors' => array('ResourceNotFound'));
		
		if(!$user->active) return array('status_code' => 800, 'errors' => array('AccountIsDisabled'));
		
		return array('status_code' => 200, 'data' => $user);
	}

	/**
	 * Ckecks if an user is active
	 * @param integer $id user id
	 * @return boolean
	 */
	public static function is_active($id) {
		$user = User::find($id);
		return $user->active;
	}

	/**
	 *	Add an user to database
	 *	@return array response
	 */
	public static function store() {

		$user_data = Input::all();

		$rules = array(
			'fbid' 		 => 'required|min:8',
			'name'       => 'required',
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email',
			'gender'     => 'required',
			'picture'    => 'required|url'
		);
		
		$validator = Validator::make($user_data, $rules);
		
		if ($validator->fails()) return array('status_code' => 800, 'errors' => $validator->messages());
		
		$user = User::updateOrCreate(array('fbid'=>$user_data['fbid']),$user_data);
		
		// return $user;
		
		if(!$user) return array('status_code' => 800, 'errors' => array('UnsupportedQueryParameter'));
		
		if(!User::is_active($user->id)) return array('status_code' => 800, 'errors' => array('AccountIsDisabled'));
		
		$token = Token::fetch($user);

		return array('status_code' => 200, 'data' => array('token' => $token->token, 'expires' => $token->expires));
	}

}
