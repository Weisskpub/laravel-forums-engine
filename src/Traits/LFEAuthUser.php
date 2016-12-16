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
	 * @return mixed
	 */
	public function isForumsAdmin()
	{
		return (boolean) $this->hasOne( Rights::class )
			->where( 'is_admin', '=', true )
			->count()
			;
	}

	/**
	 * @param $forum_id
	 * @return mixed
	 */
	public function isForumsModerator( $forum_id )
	{
		return (boolean) $this->hasOne( Rights::class )
			->where( 'is_moderator', '=', true )
			->where( 'forum_id', '=', $forum_id )
			->count()
			;
	}
}