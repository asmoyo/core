<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\User;

class UserRepo extends BaseRepo {
	
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	public function getAll()
	{
		return $this->user->all();
	}
}