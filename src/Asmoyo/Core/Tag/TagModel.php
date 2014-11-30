<?php namespace Asmoyo\Core\Tag;

use Asmoyo\Core\System\BaseModel;

class TagModel extends BaseModel {

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('title', 'slug', 'description');
	
	public function posts()
	{
		return $this->hasMany('Asmoyo\Core\Post\PostModel');
	}
}