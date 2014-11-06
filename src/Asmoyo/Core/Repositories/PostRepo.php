<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Post;

class PostRepo extends BaseRepo {
	
	protected $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}
	
	public function getAll()
	{
		return $this->post->get();
	}

	public function getById($id)
	{
		return $this->post->find($id);
	}

	public function create($id)
	{
		return $this->post->find($id);
	}
}