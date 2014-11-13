<?php namespace Asmoyo\Core\Controllers\Api;

use Asmoyo\Core\Controllers\AsmoyoController;
use Asmoyo\Core\Repositories\PageRepo;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Response, Redirect, Input;

class PageApi extends AsmoyoController {

	public function __construct(PageRepo $page)
	{
		$this->beforeFilter('csrf', ['on' => ['page', 'put', 'delete']]);
        $this->beforeFilter('asmoyo.apiFilter', [
        	'only' => ['store', 'update', 'destroy']
    	]);

		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->page->getAsMenu();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( ! $newData = $this->page->store(Input::all()) ) {
			throw new ApiValidationFailsException($this->page->getErrorAsString());
		}
		return Redirect::route('api.page.show', $newData->slug);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		if ( ! $data = $this->page->getDetail($slug)) {
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
		if ( ! $newData = $this->page->update($id, Input::all()) ) {
			throw new ApiValidationFailsException($this->page->getErrorAsString());
		}
		return Redirect::route('api.page.show', $newData->slug);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->page->destroy($id);
	}


}
