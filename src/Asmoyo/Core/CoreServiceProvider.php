<?php namespace Asmoyo\Core;

use Illuminate\Support\ServiceProvider;
use Asmoyo\Core\Exceptions\Exception as AsmoyoException;
use Asmoyo\Core\Exceptions\ApiException;
use Asmoyo\Core\Exceptions\ApiValidationFailsException;
use Config;

class CoreServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('asmoyo/core');

		$this->app->register('Intervention\Image\ImageServiceProvider');

		$this->bootstrap();
		$this->repositories();

		require_once __DIR__.'/../../filters.php';
		require_once __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->errorHandling();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('asmoyo');
	}

	/**
	 * Bind repositories.
	 *
	 * @return  void
	 */
	protected function repositories()
	{
		$this->app->bind('asmoyo.user', 'Asmoyo\Core\Repositories\UserRepo');
		$this->app->bind('asmoyo.page', 'Asmoyo\Core\Repositories\PageRepo');
		$this->app->bind('asmoyo.category', 'Asmoyo\Core\Repositories\CategoryRepo');
		$this->app->bind('asmoyo.tag', 'Asmoyo\Core\Repositories\TagRepo');
		$this->app->bind('asmoyo.post', 'Asmoyo\Core\Repositories\PostRepo');
	}

	/**
	 * Set up the database connection, needed for multiple connection
	 *
	 * @return  void
	 */
	public function bootstrap()
	{
		$connection = Config::get('core::database.default');

		if ($connection != 'default')
		{
			$asmoyoConfig 	= Config::get('core::database.connections.'.$connection);
		}
		else
		{
			$connection 	= Config::get('database.default');
			$asmoyoConfig 	= Config::get('database.connections.'.$connection);
		}

		Config::set('database.connections.asmoyo', $asmoyoConfig);
		Config::set('auth.model', 'Asmoyo\Core\Models\User');
	}

	/**
	 * Error Handle
	 */
	public function errorHandling()
	{
		$app = $this->app;

		// api several error
		$app->error(function(ApiException $e, $code)
        {
        	$code = $e->getCode() ?: $code;
        	switch ($code) {
        		case '500':
        			$message = 'Some internal error in API';
    			break;

        		case '404':
        			$message = 'Some of the aliases you requested do not exist : '. $_SERVER['REQUEST_URI'];
    			break;

        		case '403':
        			$message = 'You don\'t have permissions : '. $_SERVER['REQUEST_URI'];
    			break;
        		
        		default:
        			$message = $e->getMessage();
    			break;
        	}

	    	return \Response::json([
	        	'error' 	=> [
	                'type'		=> class_basename(get_class($e)),
	                'code' 		=> $code,
	                'message' 	=> $message,
	        	]],
	            $code
	        );
        });

        /**
         * Api validation error
         * default error code is 400 Bad Request
         */
        $app->error(function(ApiValidationFailsException $e, $code)
        {
        	$code = $e->getCode() ?: 400;
        	return \Response::json([
	        	'error' => [
	                'type'		=> class_basename(get_class($e)),
	                'code' 		=> $e->getCode() ?: 400,
	                'message' 	=> explode(',', $e->getMessage()),
	        	]],
	            $code
	        );
    	});
	}

}
