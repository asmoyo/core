<?php namespace Asmoyo\Core\Models;

class Post extends Base {

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
		return $this->belongsTo('Asmoyo\Core\Models\User');
	}


	public function category()
	{
		return $this->belongsTo('Asmoyo\Core\Models\Category');
	}


	public function tags()
	{
		return $this->belongsToMany('Asmoyo\Core\Models\Tag');
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