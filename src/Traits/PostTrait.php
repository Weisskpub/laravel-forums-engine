<?php
namespace Hzone\LFE\Traits;

use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Post;

/**
 * Class PostTrait
 * @package Hzone\LFE\Traits
 */
trait PostTrait
{
	/**
	 * Update uplinked model Topic with 'last_post' data
	 * then
	 * Update uplinked model Forum with 'last_post' data
	 * @param Post $Model
	 * @return void
	 */
	protected function updatedPost( Post $Model )
	{
		$Topic = $Model->topic()
			->with( 'forum' )
			->first()
		;
		if ( !empty( $Topic ) )
		{
			$Topic->last_post = $Model->id;
			$Topic->save();
			if ( !is_null( $Topic->forum ) )
			{
				// get the forums to update
				$ids = $Topic->forum->recursivelyGetForumsUp();
				if ( !empty( $ids ) )
				{
					Forum::whereIn( 'id', $ids )
						->update( [ 'last_post' => $Model->id ] )
					;
				}
			}
		}
	}

	/**
	 * Update Topic with 'last_post' data
	 * then
	 * Update Forum with 'last_post' data
	 * if no Posts in Topic - get last Topic fo Forum
	 * @param Post $Model
	 * @return void
	 */
	protected function deletingPost( Post $Model )
	{
		// get the Topic with Forum relation
		$Topic = $Model->topic()
			->with( 'forum' )
			->first()
		;
		if ( !is_null( $Topic ) )
		{
			// count posts in topic
			$posts = $Topic->countPosts();
			// if is not last post in topic
			if ( $posts > 1 )
			{
				// save new 'last_post' info to current Topic
				$Topic->last_post = $Model->id;
				$Topic->save();
				// get the Forum relation from Topic
				if ( !is_null( $Topic->forum ) )
				{
					// get the forums to update
					$ids = $Topic->forum->recursivelyGetForumsUp();
					if ( !empty( $ids ) )
					{
						Forum::whereIn( 'id', $ids )
							->update( [ 'last_post' => $Model->id ] )
						;
					}
				}
			}
		}
		// first Post in Topic is unremoveable!
		// remove it with Topic !
	}
}
