<?php namespace Asmoyo\Core;

use App;

class Asmoyo {

	/**
	 * Get User repository object
	 *
	 * @return \Asmoyo\Core\User\UserInterface
	 */
	public function getUser()
	{
		return App::make('Asmoyo\Core\User\UserInterface');
	}
	

	/**
	 * Get Page repository object
	 *
	 * @return \Asmoyo\Core\Page\PageInterface
	 */
	public function getPage()
	{
		return App::make('Asmoyo\Core\Page\PageInterface');
	}

	
	/**
	 * Get Category repository object
	 *
	 * @return \Asmoyo\Core\Category\CategoryInterface
	 */
	public function getCategory()
	{
		return App::make('Asmoyo\Core\Category\CategoryInterface');
	}

	
	/**
	 * Get Post repository object
	 *
	 * @return \Asmoyo\Core\Post\PostInterface
	 */
	public function getPost()
	{
		return App::make('Asmoyo\Core\Post\PostInterface');
	}

}