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

		$this->registerConnection();
		$this->registerRepository();
		$this->registerAsmoyo();
		$this->errorHandler();

		require_once __DIR__.'/../../filters.php';
		require_once __DIR__.'/../../routes.php';
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {}


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
	 * Set up the database connection, needed for multiple connection
	 *
	 * @return  void
	 */
	public function registerConnection()
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
		Config::set('auth.model', 'Asmoyo\Core\User\UserModel');
	}


	/**
	 * [registerRepository description]
	 * @return void
	 */
	protected function registerRepository()
	{
		$this->app->bind('Asmoyo\Core\User\UserInterface', 'Asmoyo\Core\User\UserRepo');
		$this->app->bind('Asmoyo\Core\Page\PageInterface', 'Asmoyo\Core\Page\PageRepo');
		$this->app->bind('Asmoyo\Core\Category\CategoryInterface', 'Asmoyo\Core\Category\CategoryRepo');
		$this->app->bind('Asmoyo\Core\Post\PostInterface', 'Asmoyo\Core\Post\PostRepo');
	}


	/**
	 * [registerAsmoyo description]
	 * @return void
	 */
	protected function registerAsmoyo()
	{
		$this->app['asmoyo'] = $this->app->share(function($app)
        {
            return new \Asmoyo\Core\Asmoyo;
        });

		$this->app->booting(function()
        {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
	        $loader->alias('Asmoyo', 'Asmoyo\Core\System\AsmoyoFacade');
        });
	}

	
	/**
	 * [errorHandler description]
	 * @return void
	 */
	public function errorHandler()
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
