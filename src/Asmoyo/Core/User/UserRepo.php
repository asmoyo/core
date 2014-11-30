<?php namespace Asmoyo\Core\User;

use Asmoyo\Core\System\BaseRepo;
use Asmoyo\Core\User\UserModel;
use Auth;

class UserRepo extends BaseRepo {
	
	protected $user;

	protected $auth;

	public function __construct(UserModel $user)
	{
		$this->user = $user;
	}
	
	public function getPaginate($limit = 10)
	{
		return $this->user->paginate($limit);
	}

	public function login($user, $password, $remember = false)
	{
		$credentials = [
			'password' 	=> $password
		];

		if( ! filter_var($user, FILTER_VALIDATE_EMAIL)) {
			$credentials['username'] = $user;
		} else {
			$credentials['email'] = $user;
		}

		if (Auth::attempt($credentials, $remember))
		{
		    return true;
		}
		return false;
	}

	public function logout()
	{
		return Auth::logout();
	}
}