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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$this->info( '################################################################################' );
		$this->info( "# Trying to backup, using \"backup-commands:database --verbose\"" );
		$this->info( '################################################################################' );
		try
		{
			$this->line( '' );
			Artisan::call( 'backup-commands:database', [ '--verbose' => true ] );
			$this->line( Artisan::output() );
		}
		catch ( Exception $e )
		{
			$this->error( '"backup-commands:database" Error !' );
			$this->error( $e->getMessage() );
			$this->line( Artisan::output() );
			return;
		}
		$this->info( '################################################################################' );
		$this->info( "# Trying to backup, using \"backup-commands:files --verbose\"" );
		$this->info( '################################################################################' );
		try
		{
			$this->line( '' );
			Artisan::call( 'backup-commands:files', [ '--verbose' => true ] );
			$this->line( Artisan::output() );
		}
		catch ( Exception $e )
		{
			$this->error( '"backup-commands:files" Error !' );
			$this->error( $e->getMessage() );
			$this->line( Artisan::output() );
			return;
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if ( $this->option( 'purge' ) )
		{
			$this->info( '################################################################################' );
			$this->info( "# Trying to purge, using \"LFE::purge --verbose --force --not-fake\"" );
			$this->info( '################################################################################' );
			$this->line( '' );
			Artisan::call( 'LFE:purge', [
				'--verbose' => true,
				'--force'   => true,
			] );
			$this->line( Artisan::output() );
			$this->line( '' );
		}
		$this->info( '################################################################################' );
		$this->info( "# Publishing migrations" );
		$this->info( '################################################################################' );
		$this->line( '' );
		Artisan::call( 'vendor:publish', [
			'--provider' => 'Hzone\LFE\LFEServiceProvider',
			'--tag'      => 'migrations',
		] );
		$this->line( Artisan::output() );
		$this->line( '' );
		$this->info( '################################################################################' );
		$this->info( "# Publishing seeds" );
		$this->info( '################################################################################' );
		$this->line( '' );
		Artisan::call( 'vendor:publish', [
			'--provider' => 'Hzone\LFE\LFEServiceProvider',
			'--tag'      => 'seeds',
		] );
		$this->info( Artisan::output() );
		$this->line( '' );
		$this->info( '################################################################################' );
		$this->info( "# Publishing assets" );
		$this->info( '################################################################################' );
		$this->line( '' );
		Artisan::call( 'vendor:publish', [
			'--provider' => 'Hzone\LFE\LFEServiceProvider',
			'--tag'      => 'assets',
			'--force'    => true,
		] );
		$this->line( Artisan::output() );
		$this->line( '' );
		if ( !is_file( base_path() . '/image.php' ) )
		{
			$this->line( '' );
			$this->info( '################################################################################' );
			$this->info( "# Publishing Intervention\Image" );
			$this->info( '################################################################################' );
			$this->line( '' );
			Artisan::call( 'vendor:publish', [ '--provider' => 'Intervention\Image\ImageServiceProviderLaravel5' ] );
			$this->line( Artisan::output() );
			$this->info( '' );
			$this->warn( 'Need to be configured "config/image.php"' );
			$this->info( '' );
		}
		$this->line( '' );
		$this->info( '################################################################################' );
		$this->info( "# Migrating the database tables into your application" );
		$this->info( '################################################################################' );
		$this->line( '' );
		Artisan::call( 'migrate' );
		$this->line( Artisan::output() );
		$this->line( '' );
		$this->line( '' );
		$this->info( '################################################################################' );
		$this->info( "# Dumping the autoloaded files and reloading all new files" );
		$composer = $this->findComposer();
		$process  = new Process( $composer . ' dump-autoload' );
		$process->setWorkingDirectory( base_path() )
			->run()
		;
		$this->info( "# Seeding data into the database" );
		$process = new Process( 'php artisan db:seed --class=LFEDatabaseSeeder' );
		$process->setWorkingDirectory( base_path() )
			->run()
		;
		$this->info( "# Adding the storage symlink to your public folder" );
		$this->info( '################################################################################' );
		$this->line( '' );
		Artisan::call( 'storage:link' );
		$this->info( Artisan::output() );
		$this->line( '' );
		$this->info( '################################################################################' );
		$this->info( "# Successfully installed Laravel Forum Engine ! Enjoy :)" );
		$this->info( '################################################################################' );
		$this->line( '' );

		return;
	}
}
