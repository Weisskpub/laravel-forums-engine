<?php
namespace Hzone\LFE\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

class LFEInstallCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'LFE:install';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the Laravel Forum Engine package';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			[
				'purge',
				null,
				InputOption::VALUE_NONE,
				'Purge existing forums, topic, comments, etc.',
				null,
			],
		];
	}

	/**
	 * Get the composer command for the environment.
	 *
	 * @return string
	 */
	protected function findComposer()
	{
		if ( file_exists( getcwd() . '/composer.phar' ) )
		{
			return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
		}

		return 'composer';
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info( "Trying to backup, using \"h-zone/laravel-backup-commands\"" );
		try
		{
			Artisan::call( 'backup-commands:database' );
			Artisan::call( 'backup-commands:files' );
		}
		catch ( Exception $e )
		{
			$this->info( '"h-zone/laravel-backup-commands" NOT YET INSTALLED (CONFIGURED) ?' );
		}
		if ( !$this->option( 'purge' ) )
		{
			$this->info( "Purging default forums [ DISABLED DUE TO NO COMMAND ]" );
			//Artisan::call('LFE:purge');
		}
		$this->info( "Publishing the Laravel Forum Engine assets, database, config files and Dependency Packages" );
		Artisan::call( 'vendor:publish', [ '--provider' => 'Hzone\LFE\LFEServiceProvider' ] );
		if ( !is_file( base_path() . '/image.php' ) )
		{
			Artisan::call( 'vendor:publish', [ '--provider' => 'Intervention\Image\ImageServiceProviderLaravel5' ] );
			$this->info( 'Need to be configured "config/image.php"' );
		}
		$this->info( "Migrating the database tables into your application" );
		Artisan::call( 'migrate' );
		$this->info( "Dumping the autoloaded files and reloading all new files" );
		$composer = $this->findComposer();
		$process  = new Process( $composer . ' dump-autoload' );
		$process->setWorkingDirectory( base_path() )
			->run()
		;
		$this->info( "Seeding data into the database" );
		$process = new Process( 'php artisan db:seed --class=LFEDatabaseSeeder' );
		$process->setWorkingDirectory( base_path() )
			->run()
		;
		$this->info( "Adding the storage symlink to your public folder" );
		Artisan::call( 'storage:link' );
		$this->info( "Successfully installed Laravel Forum Engine ! Enjoy :)" );

		return;
	}
}
