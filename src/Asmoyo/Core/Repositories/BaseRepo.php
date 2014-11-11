<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Exceptions\Exception;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Validator, Config, Input;

abstract class BaseRepo {
	
	protected $model;

    protected $validator;

	public function __construct($model = null)
	{
		$this->model = $model;
	}

	protected function isValid($attr, $rules)
    {
        $this->validator = Validator::make($attr, $rules);
        return $this->validator->passes();
    }

    public function getError()
    {
        return $this->validator->messages()->all();
    }

    public function getErrorAsString($delimiter = ',')
    {
        return implode($this->validator->messages()->all(), $delimiter);
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