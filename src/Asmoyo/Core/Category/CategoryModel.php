<?php namespace Asmoyo\Core\Category;

use Asmoyo\Core\System\BaseModel;

class CategoryModel extends BaseModel {

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('parent_id', 'title', 'slug', 'description');

	public function posts()
	{
		return $this->hasMany('Asmoyo\Core\Post\PostModel', 'category_id');
	}
}