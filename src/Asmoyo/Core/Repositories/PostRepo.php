<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Post;

class PostRepo extends BaseRepo {
	
	protected $post;

	public function __construct(Post $post)
	{
		parent::__construct($post);
		$this->post = $post;
	}

	public function getPaginateWithCategory()
	{
		return $this->post->with('category')->paginate(10);
	}

	public function getOneWithCategory($id)
	{
		if ( ! $data = $this->post->with('category')->find($id))
		{
			return false;
		}
		return $data;
	}

}