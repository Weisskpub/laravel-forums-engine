<?php
namespace Hzone\LFE\Model;

use Carbon\Carbon;

/**
 * Class WhoOnline
 * @package Hzone\LFE\Model
 */
class WhoOnline
{
	/**
	 * @param int $duration - default 15 minutes, otherwise app settings
	 * @return mixed
	 */
	public static function getOnlineUsers( $duration = null )
	{
		$return = [];
		$now    = Carbon::now();
		$target = $now->copy();
		$target->subMinutes( 15 );
		switch ( config( 'session.driver' ) )
		{
			// todo: make another possibilities to read sessions from another session drivers
			case 'database':
				return self::databaseActivity( $target );
				break;
		}

		return $return;
	}

	/**
	 * @param $target
	 * @return mixed
	 */
	protected static function databaseActivity( $target )
	{
		return LFESession::where( 'last_activity', '>', $target->getTimestamp() )
			->with( [
				'user' => function ( $query )
				{
					return $query->select( 'id', config( 'LFE.username_column' ) );
				},
			] )
			->orderBy( 'last_activity', 'desc' )
			->take( 200 )
			->get( [
				'last_activity',
				'user_id',
			] )
			;
	}
}