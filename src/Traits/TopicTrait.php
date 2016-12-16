<?php
namespace Hzone\LFE\Traits;

use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;

/**
 * Class TopicTrait
 * @package Hzone\LFE\Traits
 */
trait TopicTrait
{
	/**
	 * Update Topic with 'last_post' data
	 * then
	 * Update Forum with 'last_post' data
	 * if no Posts in Topic - get last Topic fo Forum
	 * @param Post $Model
	 * @return void
	 */
	protected function deletingTopic( Topic $Model )
	{
		// get the last post of given topic <= forum
		$LastPost = $Model->forum->posts()
			->where( 'lfe_topics.id', '!=', $Model->id )
			->orderBy( 'updated_at', 'desc' )
			->with( [
				'topic' => function ( $query )
				{
					return $query->with( 'forum' );
				},
			] )
			->first()
		;
		if ( !empty( $LastPost ) )
		{
			$last_post = $LastPost->id;
		}
		else
		{
			$last_post = null;
		}
		// get the forums to update
		if ( !is_null( $LastPost ) )
		{
			$ids = $LastPost->topic->forum->recursivelyGetForumsUp();
			if ( !empty( $ids ) )
			{
				Forum::whereIn( 'id', $ids )
					->update( [ 'last_post' => $last_post ] )
				;
			}
		}
		else
		{
			$ids = $Model->forum->recursivelyGetForumsUp();
			if ( !empty( $ids ) )
			{
				Forum::whereIn( 'id', $ids )
					->update( [ 'last_post' => null ] )
				;
			}
		}
	}
}
