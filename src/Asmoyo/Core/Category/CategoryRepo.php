<?php namespace Asmoyo\Core\Category;

use Asmoyo\Core\System\BaseRepo;

class CategoryRepo extends BaseRepo implements CategoryInterface {
	
	protected $category;

	public function __construct(CategoryModel $category)
	{
		parent::__construct($category);
		$this->category = $category;
	}

	public function getPaginate($limit = 10)
	{
		return $this->category->orderBy('created_at', 'desc')->paginate($limit);
	}

	public function getPaginateWithPost($limit = 10)
	{
		return $this->category->with('posts')->orderBy('created_at', 'desc')->paginate($limit);
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
	 * get as dropdown
	 * @param field_value for value
	 * @param field_text for display text
	 * @return array
	 */
	public function getAsDropdown($field_value = 'id', $field_text = 'title')
	{
		$result = ['0' => 'Select Categories'];
		$categories = $this->category->get()->toArray();
		if ($categories) {
			foreach ($categories as $item) {
	            $result[$item[$field_value]] = $item[$field_text];
	        }
		}
		return $result;
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
			'slug'			=> 'required|unique:'. $this->category->getTable() .',slug,'. $id,
			'description'	=> 'required',
		]);
	}
}