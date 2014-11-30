<?php namespace Asmoyo\Core\Page;

use Asmoyo\Core\System\BaseModel;

class PageModel extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('user_id', 'parent_id', 'title', 'slug', 'view_path', 'order');


	public function user()
	{
		return $this->belongsTo('Asmoyo\Core\User\UserModel', 'user_id');
	}

	protected function validateCreate()
	{
		return array(
			'title'			=> 'required',
			'slug'			=> 'required',
			'view_path'		=> 'required',
		);
	}
}