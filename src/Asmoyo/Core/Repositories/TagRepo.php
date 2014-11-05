<?php namespace Asmoyo\Core\Repositories;

use Asmoyo\Core\Models\Tag;

class TagRepo extends BaseRepo {
	
	protected $tag;

	public function __construct(Tag $tag)
	{
		$this->tag = $tag;
	}
	
	public function getAll()
	{
		return $this->tag->all();
	}
}