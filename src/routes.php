<?php

$api_url = Config::get('core::asmoyo.api_url_prefix');

Route::group(array('prefix' => $api_url, 'before' => ['asmoyo.api']), function() {
	
	Route::resource('category', 'Asmoyo\Core\Controllers\Api\CategoryApi', array(
		'names' => array(
			'index'		=> 'api.category.index',
			'show'		=> 'api.category.show',
			'store' 	=> 'api.category.store',
			'update' 	=> 'api.category.update',
			'destroy' 	=> 'api.category.destroy',
		),
		'except'	=> ['create', 'edit']
	));
	Route::resource('post', 'Asmoyo\Core\Controllers\Api\PostApi', array(
		'names' => array(
			'index'		=> 'api.post.index',
			'show'		=> 'api.post.show',
			'store' 	=> 'api.post.store',
			'update' 	=> 'api.post.update',
			'destroy' 	=> 'api.post.destroy',
		),
		'except'	=> ['create', 'edit']
	));

});

Route::get('/logout', function() {
	return Auth::logout();
});