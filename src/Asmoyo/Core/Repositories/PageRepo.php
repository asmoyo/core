<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Page;

class PageRepo extends BaseRepo {
	
	protected $page;

	public function __construct(Page $page)
	{
		parent::__construct($page);
		$this->page = $page;
	}

	public function getAsMenu()
	{
		return $this->page->select('parent_id', 'title', 'slug', 'order')->orderBy('order', 'asc')->get();
	}

	public function getDetail($slug)
	{
		if ( ! $data = $this->page->where('slug', $slug)->first())
		{
			return false;
		}
		return $data;
	}

	/**
	 * @param attr array
	 * @return Eloquent\Model
	 */
	public function store($attr = array())
	{
		$attr 		= $attr ?: Input::all();
		$newData 	= $this->getNewInstance($attr);

		if ( ! $this->validationForCreate($newData->getAttributes()) )
		{
			return false;
		}

		$newData->save();
		return $newData;
	}

	/**
	 * @param id : integer
	 * @param attr : array
	 * @return \Eloquent\Model
	 */
	public function update($id, $attr = array())
	{
		$attr 		= $attr ?: Input::all();
		$newData 	= $this->getById($id)->fill($attr);

		if ( ! $this->validationForUpdate($id, $attr)) {
			return false;
		}

		$newData->save();
		return $newData;
	}

	/**
	 * @param id
	 * @return bool
	 */
	public function destroy($id)
	{
		return $this->page->where('id', $id)->delete();
	}

	protected function validationForCreate($attr = array())
	{
		return $this->isValid($attr, array(
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->page->getTable() .',slug',
			'description'	=> 'required',
		));
	}

	protected function validationForUpdate($id, $attr = array())
	{
		return $this->isValid($attr, array(
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->page->getTable() .',slug,'. $id,
			'description'	=> 'required',
		));
	}

}