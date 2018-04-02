<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Kbs1\EncryptedApiServerLaravel\Client\ClientConfigurationProviderInterface;
use App\Client\ClientConfigurationProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(ClientConfigurationProviderInterface::class, ClientConfigurationProvider::class);
	}
}
