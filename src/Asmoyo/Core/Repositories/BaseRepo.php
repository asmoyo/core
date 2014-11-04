<?php namespace Asmoyo\Core\Repositories;

abstract class BaseRepo {
	
	protected $model;

	public function __construct(null $model)
	{
		$this->model = $model;
	}
	
}