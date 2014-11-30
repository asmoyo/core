<?php namespace Asmoyo\Core\Post;

use Asmoyo\Core\System\BaseModel;

class PostModel extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('user_id', 'category_id', 'title', 'slug', 'description', 'content', 'meta_title', 'meta_keywords', 'meta_description');

	/**
	 * Appends custom attribute
	 */
	protected $appends = array('parsed_content');


	public function user()
	{
		return $this->belongsTo('Asmoyo\Core\User\UserModel', 'user_id');
	}


	public function category()
	{
		return $this->belongsTo('Asmoyo\Core\Category\CategoryModel', 'category_id');
	}


	protected function validateCreate()
	{
		return array(
			'title'		=> 'required',
			'slug'		=> 'required',
			'description'	=> 'required',
			'content'	=> 'required',
		);
	}


	public function getParsedContentAttribute()
	{
		$parsed = new \Parsedown();
		return $parsed->text($this->attributes['content']);
	}
}