<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Category;

class CategoryRepo extends BaseRepo {
	
	protected $category;

	public function __construct(Category $category)
	{
		parent::__construct($category);
		$this->category = $category;
	}

	public function getAllWithPosts()
	{
		return $this->category->with('posts')->get();
	}

	public function getOneWithPosts($id)
	{
		return $this->category->with('posts')->find($id);
	}
}