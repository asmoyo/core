<?php

$api_url = Config::get('core::asmoyo.api_url_prefix');

Route::group(['namespace' => 'Asmoyo\Core\Controllers\Api', 'prefix' => $api_url], function() {
	
	Route::resource('category', 'CategoryApi', array(
		'names' => array(
			'index'		=> 'api.category.index',
			'show'		=> 'api.category.show',
			'store' 	=> 'api.category.store',
			'update' 	=> 'api.category.update',
			'destroy' 	=> 'api.category.destroy',
		),
		'except'	=> ['create', 'edit']
	));
	Route::resource('post', 'PostApi', array(
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