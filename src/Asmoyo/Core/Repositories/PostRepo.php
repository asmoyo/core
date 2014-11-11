<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Post;

class PostRepo extends BaseRepo {
	
	protected $post;

	public function __construct(Post $post)
	{
		parent::__construct($post);
		$this->post = $post;
	}

	public function getPaginate($limit = 10)
	{
		return $this->post->with('category')->paginate($limit);
	}

	public function getDetail($slug)
	{
		if ( ! $data = $this->post->with('category')->where('slug', $slug)->first())
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
	 * @param id
	 * @param attr
	 * @return \Eloquent\Model
	 */
	public function update($id, $attr = array())
	{
		$attr 		= $attr ?: Input::all();
		$newData 	= $this->getById($id);
		$newData 	= $newData->fill($attr);

		if ( ! $this->validationForUpdate($id, $attr)) {
			return false;
		}

		$newData->save();
		return $newData;
	}

	public function validationForCreate($attr = array())
	{
		return $this->isValid($attr, array(
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->post->getTable() .',slug',
			'description'	=> 'required',
		));
	}

	public function validationForUpdate($id, $attr = array())
	{
		return $this->isValid($attr, array(
			'title'			=> 'required',
			'slug'			=> 'required|unique:'. $this->post->getTable() .',slug,'. $id,
			'description'	=> 'required',
		));
	}

}