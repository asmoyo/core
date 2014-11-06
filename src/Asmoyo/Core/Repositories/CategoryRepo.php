<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Category;

class CategoryRepo extends BaseRepo {
	
	protected $category;

	public function __construct(Category $category)
	{
		parent::__construct($category);
		$this->category = $category;
	}

	public function getPaginateWithPosts()
	{
		return $this->category->with('posts')->paginate();
	}

	public function getOneWithPosts($id)
	{
		return $this->category->with('posts')->find($id);
	}
}