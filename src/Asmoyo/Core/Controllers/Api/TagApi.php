<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Tag\TagRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Response, Redirect, Input;

class TagApi extends AsmoyoController {

	public function __construct(TagRepo $tag)
	{
		$this->beforeFilter('csrf', ['on' => ['tag', 'put', 'delete']]);
        $this->beforeFilter('asmoyo.apiFilter', [
        	'only' => ['store', 'update', 'destroy']
    	]);

		$this->tag = $tag;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->tag->getPaginate();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( ! $newData = $this->tag->store(Input::all()) ) {
			throw new ApiValidationFailsException($this->tag->getErrorAsString());
		}
		return Redirect::route('api.tag.show', $newData->slug);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		if ( ! $data = $this->tag->getDetail($slug)) {
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
		if ( ! $newData = $this->tag->update($id, Input::all()) ) {
			throw new ApiValidationFailsException($this->tag->getErrorAsString());
		}
		return Redirect::route('api.tag.show', $newData->slug);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->tag->destroy($id);
	}


}
