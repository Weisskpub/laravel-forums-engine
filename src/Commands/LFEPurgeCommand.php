<?php
namespace Hzone\LFE\Commands;

use Hzone\LFE\Model\FAggr;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class LFEPurgeCommand
 * @package Hzone\LFE\Commands
 */
class LFEPurgeCommand extends Command
{
	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'LFE:purge';
	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Purge the laravel-forums-engine Database';

	/**
	 * Create a new command instance.
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
				'force',
				null,
				InputOption::VALUE_NONE,
				'No confirmation while purging',
				null,
			],
			[
				'not-fake',
				null,
				InputOption::VALUE_NONE,
				'No confirmation while purging',
				null,
			],
		];
	}

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
		$purge = false;
		if ( $this->option( 'force' ) )
		{
			$this->warn( "Force purging LFE tables..." );
			$purge = true;
		}
		else
		{
			if ( $this->confirm( 'Really delete all forums/topics/posts?', false ) )
			{
				$this->warn( "Purging LFE tables..." );
				$purge = true;
			}
			else
			{
				$this->warn( "Purging CANCELED" );
			}
		}
		if ( $purge == true )
		{
			if ( class_exists( FAggr::class ) )
			{
				try
				{
					if ( $this->option( 'not-fake' ) )
					{
						$FAggr = new FAggr;
						$FAggr->delete();
					}
				}
				catch ( \Exception $e )
				{
					$this->error( $e->getMessage() );
				}
			}
			$this->info( "Successfully purged ." );
		}

		return;
	}
}
