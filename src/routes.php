<?php

$api_url = Config::get('core::asmoyo.api_url_prefix');

Route::group(array('prefix' => $api_url, 'before' => ['auth.basic', 'asmoyo.api']), function() {
	
	Route::resource('category', 'Asmoyo\Core\Controllers\Api\CategoryApi');
	Route::resource('post', 'Asmoyo\Core\Controllers\Api\PostApi');

});

Route::get('/logout', function() {
	return Auth::logout();
});