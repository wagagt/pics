<?php
// use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'admins';
	protected $fillable = array('name', 'email', 'password', 'rol', 'remember_token', 'status');
	protected $hidden = array('comment');
	
	// Add your validation rules here
	public static $rules = [
		'name' => 'required|min:5',
		'email' => 'required|email',
		'password' => 'required|min:5|confirmed',
		'password_confirmation' => 'required|min:5',
		'rol' => 'required'
	];

	/* Custom messages */
	
	public static $messages = [
	'required' => '&nbsp;Campo requerido',
	'confirmed' => '&nbsp;Campo debe confirmarse',
    'same'    => '&nbsp;:attribute y :other deben ser iguales.',
    'size'    => '&nbsp;:attribute debe ser de tamaño :size.',
    'between' => '&nbsp;:attribute debe estar dentro del rango :min - :max.',
    'in'      => '&nbsp;:attribute debe ser de uno de éstos tipos: :values',
    'date'    => '&nbsp;Fecha con formato incorrecto',
    'date_format'=> '&nbsp;Fecha con formato incorrecto',
	];

	public static function validate ($data){
		 return  Validator::make($data, static::$rules, static::$messages);
	}
	
	public function getDates()
	{
	    //return array(static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT, 'date_birth', 'date_out');
	    return array_merge(parent::getDates(), array('date_birth', 'date_out'));
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
	    return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
	    return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
	    return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	public static function get_enum_values ( $column){
		$data = DB::table('information_schema.COLUMNS')
		->select (DB::raw('SUBSTRING(COLUMN_TYPE,5) AS values'))
		->where('TABLE_NAME', '=', 'admins')
		->where('COLUMN_NAME', '=', $column)
		;
		//->get();
	}

}