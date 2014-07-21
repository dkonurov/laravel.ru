<?php namespace SU\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider{

	public function register()
	{
		// Регистрация сервис-провайдеров приложения
		$this->app->register('SU\Docs\DocsServiceProvider');
		$this->app->register('SU\User\UserServiceProvider');

		// регистрация папки Views
		$viewPaths = \Config::get('view.paths');
		$viewPaths[] = __DIR__ . '/Views';
		\Config::set('view.paths', $viewPaths);

		include __DIR__.'/core_exceptions.php';
		include __DIR__.'/core_routes.php';

	}

	public function boot()
	{

	}
}