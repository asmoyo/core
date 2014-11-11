<?php

use Asmoyo\Core\Exceptions\ApiException;

/**
 * Require api permission
 * specify api which require admin permission
 */
Route::filter('asmoyo.apiFilter', function($route, $request, $value = null)
{
    if (Auth::guest())
	{
		throw new ApiException("Unauthorized", 401);
	}
});

/**
 * Require admin permission
 */
Route::filter('asmoyo.adminFilter', function($route, $request, $value = null)
{
    if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

