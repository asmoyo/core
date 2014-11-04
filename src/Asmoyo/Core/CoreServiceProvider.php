<?php namespace Asmoyo\Core;

use Illuminate\Support\ServiceProvider;
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
		$this->setConnection();
		$this->bindRepositories();

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
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
	 * Bind repositories.
	 *
	 * @return  void
	 */
	protected function bindRepositories()
	{
		$this->app->bind('Asmoyo\Core\Repositories\UserRepoInterface', 'Asmoyo\Core\Repositories\UserRepo');
	}

	/**
	 * Set up the database connection, needed for multiple connection
	 *
	 * @return  void
	 */
	public function setConnection()
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
	}

}
