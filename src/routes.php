<?php

$api_url = Config::get('core::asmoyo.api_url_prefix');

Route::group(array('prefix' => $api_url), function() {

	Route::get('hello', function() {

		$object = new Asmoyo\Core\Models\Post;
		Debugbar::info($object->with('category')->get());
		return 'testing berhasil';
	});
	// Route::resource();

});