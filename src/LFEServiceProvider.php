<?php
namespace Hzone\LFE;

use Hzone\LFE\Commands\LFEInstallCommand;
use Hzone\LFE\Middleware\LFEMiddleware;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LFEServiceProvider extends ServiceProvider
{
	private $routeNamespace = 'Hzone\\LFE\\Controllers';

	/**
	 * Bootstrap the application services.
	 *
	 * @param Router $router
	 */
	public function boot( Router $router )
	{
		$router->middleware( 'LFE.user', LFEMiddleware::class );
		$this->loadViewsFrom( __DIR__ . '../../resources/views', 'LFE' );
		$router->group( [
			'prefix'    => config( 'LFE.routes.prefix', 'forums' ),
			'namespace' => $this->routeNamespace,
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
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerResources();
		$this->app->booting( function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias( 'Satellite', Satellite::class );
			$loader->alias( 'Forum', Model\Forum::class );
			$loader->alias( 'Topic', Model\Topic::class );
			$loader->alias( 'Post', Model\Post::class );
		} );
		$this->app[ 'command.LFE' ] = $this->app->share( function ( $app )
		{
			return new LFEInstallCommand;
		} );
		$this->commands( 'command.LFE' );
	}

	/**
	 * @return void
	 */
	protected function registerResources()
	{
		$this->publishes( [
			__DIR__ . '/../public' => public_path( 'vendor/LFE' ),
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
}

