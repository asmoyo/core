<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Category;

class CategoryRepo extends BaseRepo {
	
	protected $category;

	public function __construct(Category $category)
	{
		parent::__construct($category);
		$this->category = $category;
	}

	public function getPaginate()
	{
		return $this->category->with('posts')->paginate();
	}

	public function getDetail($slug)
	{
		if ( ! $data = $this->category->with('posts')->where('slug', $slug)->first())
		{
			return false;
		}
		return $data;
	}

	/**
	 * @param attr array
	 * @return Eloquent\Model
	 */
	public function store($attr = [])
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
		return $this->category->where('id', $id)->delete();
	}

	protected function validationForCreate($attr = [])
	{
		return $this->isValid($attr, [
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->category->getTable() .',slug',
			'description'	=> 'required',
		]);
	}

	protected function validationForUpdate($id, $attr = [])
	{
		return $this->isValid($attr, [
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->category->getTable() .',slug',
			'description'	=> 'required',
		]);
	}
}