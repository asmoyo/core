<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Repositories\CategoryRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Response, Redirect, Input;

class CategoryApi extends AsmoyoController {

	public function __construct(CategoryRepo $category)
	{
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
        $this->beforeFilter('asmoyo.apiFilter', [
        	'only' => ['store', 'update', 'destroy']
    	]);
    	
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->category->getPaginate();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( ! $newData = $this->category->store(Input::all()) ) {
			throw new ApiValidationFailsException($this->category->getErrorAsString());
		}
		return Redirect::route('api.category.show', $newData->slug);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		if ( ! $data = $this->category->getDetail($slug)) {
			throw new ApiException("Resource could not be found with slug=$slug", 404);
		}
		return $data;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ( ! $newData = $this->category->update($id, Input::all()) ) {
			throw new ApiValidationFailsException($this->category->getErrorAsString());
		}
		return Redirect::route('api.category.show', $newData->slug);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->category->destroy($id);
	}


}
