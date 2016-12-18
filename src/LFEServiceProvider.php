<?php
namespace Hzone\LFE;

use Hzone\LFE\Commands\LFEInstallCommand;
use Hzone\LFE\Commands\LFEPurgeCommand;
use Hzone\LFE\Middleware\LFEMiddleware;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class LFEServiceProvider
 * @package Hzone\LFE
 */
class LFEServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the application services.
	 * @param Router $router
	 */
	public function boot( Router $router )
	{
		$this->loadTranslationsFrom( realpath( __DIR__ . '/../resources/lang' ), 'LFE' );
		$this->loadViewsFrom( realpath( __DIR__ . '/../resources/views/LFE' ), 'LFE' );
		$router->middleware( 'LFE.user', LFEMiddleware::class );
		$router->group( [
			'prefix'    => config( 'LFE.routes.prefix', 'forums' ),
			'namespace' => 'Hzone\\LFE\\Controllers',
		], function ()
		{
			if ( !$this->app->routesAreCached() )
			{
				require __DIR__ . '/routes.php';
			}
		} );
	}

	/**
	 * Register the application services.
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom( __DIR__ . '/../config/LFE.php', 'LFE' );
		// enable https in asset() and url() generators
		if ( config( 'LFE.https' ) == true )
		{
			url()->forceSchema('https');
		}
		$this->registerResources();
		$this->registerCommands();
		$this->registerAliases();
	}

	/**
	 * @return void
	 */
	protected function registerResources()
	{

		// Publish assets
		$this->publishes( [
			__DIR__ . '/../public/LFE' => public_path( 'vendor/LFE' ),
		], 'assets' );

		// Publish the migrations to the migrations folder
		$this->publishes( [
			__DIR__ . '/../database/migrations/' => database_path( 'migrations' ),
		], 'migrations' );

		// Publish the seeds to the seeds folder
		$this->publishes( [
			__DIR__ . '/../database/seeds/' => database_path( 'seeds' ),
		], 'seeds' );

		// Publish the content/uploads content to the migrations folder
		$this->publishes( [
			__DIR__ . '/../config/LFE.php' => config_path( 'LFE.php' ),
		], 'config' );

		// Publish the post view
		$this->publishes( [
			__DIR__ . '/../resources/views/' => resource_path( 'views' ),
		], 'views' );

		// Publish the localizations
		$this->publishes( [
			__DIR__ . '/../resources/lang/' => resource_path( 'lang' ),
		], 'lang' );
	}

	/**
	 * @return void
	 */
	protected function registerCommands()
	{
		$this->commands( [
			LFEInstallCommand::class,
			LFEPurgeCommand::class,
		] );
	}

	/**
	 * @return void
	 */
	protected function registerAliases()
	{
		$this->app->booting( function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias( 'Satellite', Satellite::class );
			$loader->alias( 'WhoOnline', Model\WhoOnline::class );
			$loader->alias( 'LFESession', Model\LFESession::class );
			$loader->alias( 'FAggr', Model\FAggr::class );
			$loader->alias( 'Forum', Model\Forum::class );
			$loader->alias( 'Topic', Model\Topic::class );
			$loader->alias( 'Post', Model\Post::class );
		} );
	}

}
