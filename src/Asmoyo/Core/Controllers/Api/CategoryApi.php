<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Repositories\CategoryRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Response;

class CategoryApi extends AsmoyoController {

	public function __construct(CategoryRepo $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->category->getAll();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return \Input::all();
		return Response::json(array(
			'success'	=> 'success',
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
		if ( ! $data = $this->category->getById($id)) {
			throw new ApiException("Resource could not be found with id=$id", 404);
		}
		return $data;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
