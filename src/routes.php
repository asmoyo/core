<?php

$api_url = Config::get('core::asmoyo.api_url_prefix');

Route::group(array('prefix' => $api_url, 'before' => ['asmoyo.api']), function() {
	
	Route::resource('category', 'Asmoyo\Core\Controllers\Api\CategoryApi', array(
		'names' => array(
			'index'		=> 'apis.category.index',
			'show'		=> 'apis.category.show',
			'store' 	=> 'apis.category.store',
			'update' 	=> 'apis.category.update',
			'destroy' 	=> 'apis.category.destroy',
		),
		'except'	=> ['create', 'edit']
	));
	Route::resource('post', 'Asmoyo\Core\Controllers\Api\PostApi', array(
		'names' => array(
			'index'		=> 'apis.post.index',
			'show'		=> 'apis.post.show',
			'store' 	=> 'apis.post.store',
			'update' 	=> 'apis.post.update',
			'destroy' 	=> 'apis.post.destroy',
		),
		'except'	=> ['create', 'edit']
	));

});

Route::get('/logout', function() {
	return Auth::logout();
});