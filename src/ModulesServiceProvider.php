<?php namespace Ionut\Modules;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['modules.package'] = new Package;

		$this->app->bindShared(Modules::class, function($app){
			return $this->app['modules.package']['modules'];
		});
	}
}