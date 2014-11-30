<?php namespace Asmoyo\Core\User;

interface UserInterface {

	public function getPaginate($limit = 10);

	public function login($user, $password, $remember = false);

	public function logout();
	
}