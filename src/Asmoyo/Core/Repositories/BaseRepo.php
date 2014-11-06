<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\Exception;

abstract class BaseRepo {
	
	protected $model;

	public function __construct($model = null)
	{
		$this->model = $model;
	}

	public function isValid()
    {
        if ( ! isset($this->validationRules)) {
            throw new NoValidationRules('no validation rule array defined in class ' . get_called_class());
        }
        $this->validator = Validator::make($this->getAttributes(), $this->getPreparedRules());

        return $this->validator->passes();
    }

    public function getNewInstance($attributes = array())
    {
    	$attributes = $attributes ?: Input::only($this->model->getFillable()) ;
    	return $this->model->newInstance($attributes);
    }

    public function getAll()
    {
        return $this->model->get();
    }
	
    public function getPaginate()
    {
        return $this->model->paginate(10);
    }

    public function getById($id)
    {
        if ( ! $data = $this->model->find($id)) {
            return false;
        }
        return $data;
    }

    public function getBySlug($slug)
    {
        if ( ! $data = $this->model->where('slug', $slug)->first()) {
            return false;
        }
        return $data;
    }
}