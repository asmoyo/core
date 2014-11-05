<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Category;

class CategoryRepo extends BaseRepo {
	
	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}
	
	public function getAll()
	{
		return $this->category->all();
	}
}