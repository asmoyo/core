<?php namespace Asmoyo\Core\Tag;

use Asmoyo\Core\System\BaseRepo;
use Asmoyo\Core\Tag\TagModel;

class TagRepo extends BaseRepo {
	
	protected $tag;

	public function __construct(TagModel $tag)
	{
		$this->tag = $tag;
	}
	
	public function getPaginate()
	{
		return $this->tag->with('posts')->orderBy('created_at', 'desc')->paginate();
	}

	public function getDetail($slug)
	{
		if ( ! $data = $this->tag->with('posts')->where('slug', $slug)->first())
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
		return $this->tag->where('id', $id)->delete();
	}

	protected function validationForCreate($attr = [])
	{
		return $this->isValid($attr, [
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->tag->getTable() .',slug',
			'description'	=> 'required',
		]);
	}

	protected function validationForUpdate($id, $attr = [])
	{
		return $this->isValid($attr, [
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->tag->getTable() .',slug',
			'description'	=> 'required',
		]);
	}
}