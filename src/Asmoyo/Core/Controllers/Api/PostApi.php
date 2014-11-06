<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Repositories\PostRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Response;

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
		return Response::json(array(
			'success'	=> true,
		));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if ( ! $data = $this->post->getById($id)) {
			throw new ApiException("Resource could not be found with id=$id", 404);
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
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
