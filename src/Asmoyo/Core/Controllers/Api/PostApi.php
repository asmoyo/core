<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Repositories\PostRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Response, Redirect, Input;

class PostApi extends AsmoyoController {

	public function __construct(PostRepo $post)
	{
		$this->post = $post;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->post->getPaginate();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( ! $newData = $this->post->store(Input::all()) ) {
			throw new ApiValidationFailsException($this->post->getErrorAsString());
		}
		return Redirect::route('api.post.show', $newData->slug);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		if ( ! $data = $this->post->getDetail($slug)) {
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
		if ( ! $newData = $this->post->update($id, Input::all()) ) {
			throw new ApiValidationFailsException($this->post->getErrorAsString());
		}
		return Redirect::route('api.post.show', $newData->slug);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->post->destroy($id);
	}


}
