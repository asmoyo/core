<?php namespace Asmoyo\Core\Models;

class Category extends Base {

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
		return $this->hasMany('Asmoyo\Core\Models\Post');
	}
}