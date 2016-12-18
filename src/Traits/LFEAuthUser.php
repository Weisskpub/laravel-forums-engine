<?php
namespace Hzone\LFE\Traits;

use Hzone\LFE\Model\Rights;

/**
 * Class LFEAuthUser
 * @package Hzone\LFE\Traits
 */
trait LFEAuthUser
{
	/**
	 * @param integer $forum_id
	 * @return boolean
	 */
	public function isForumsAdmin( $forum_id=null )
	{
		if ( !empty( $forum_id ) )
		{
			// IS FORUM MODERATOR
			return (boolean) $this->hasOne( Rights::class )
				->where( 'is_admin', '=', true )
				->where( 'forum_id', '=', $forum_id )
				->count()
				;
		}
		else
		{
			// IS GLOBAL MODERATOR
			return (boolean) $this->hasOne( Rights::class )
				->where( 'is_admin', '=', true )
				->whereNull( 'forum_id' )
				->count()
				;
		}
	}

	/**
	 * @param integer $forum_id
	 * @return boolean
	 */
	public function isForumsModerator( $forum_id=null )
	{
		if ( !empty( $forum_id ) )
		{
			// IS FORUM MODERATOR
			return (boolean) $this->hasOne( Rights::class )
				->where( 'is_moderator', '=', true )
				->where( 'forum_id', '=', $forum_id )
				->count()
				;
		}
		else
		{
			// IS GLOBAL MODERATOR
			return (boolean) $this->hasOne( Rights::class )
				->where( 'is_moderator', '=', true )
				->whereNull( 'forum_id' )
				->count()
				;
		}
	}
}