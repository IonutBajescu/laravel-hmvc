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
		$this->app->bindShared(Modules::class, function($app){
			return Modules::bootstrapIfExists(app_path('Modules'));
		});
	}
}