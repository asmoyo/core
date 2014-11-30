<?php namespace Asmoyo\Core\System;

use Illuminate\Support\Facades\Facade;

class AsmoyoFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'asmoyo';
	}

}
