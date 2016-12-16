<?php
namespace Hzone\LFE;

use Carbon\Carbon;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Post;
use Hzone\LFE\Model\Topic;
use Illuminate\Support\Debug\Dumper;

class Satellite
{
	/**
	 * @param \Hzone\LFE\Model\Forum $Forum
	 * @return string
	 */
	public static function makeForumUrl( Forum $Forum )
	{
		return url( config( 'LFE.routes.prefix' ) . '/f-' . $Forum->id . '-' . self::seoAddress( $Forum->title ) );
	}

	/**
	 * @param \Hzone\LFE\Model\Topic $Topic
	 * @return string
	 */
	public static function makeTopicUrl( Topic $Topic )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $Topic->id . '-' . self::seoAddress( $Topic->title ) );
	}

	/**
	 * @param Post $Post
	 * @param bool $last_post
	 * @return string
	 */
	public static function makePostUrl( Post $Post, $last_post = false )
	{
		$url = url( config( 'LFE.routes.prefix' ) . '/p-' . $Post->id );
		$url .= '#post-'.$Post->id;

		return $url;
	}

	/**
	 * @param object $User
	 * @return string
	 */
	public static function makeUserUrl( $User )
	{
		if ( !empty( $User ) )
		{
			$name = self::seoAddress( $User->{config( 'LFE.username_column' )} );

			return url( config( 'LFE.routes.prefix' ) . '/user/' . $User->id . '-' . $name );
		}
		else
		{
			return url( config( 'LFE.routes.prefix' ) . '/users' );
		}
	}

	/**
	 * @param $datetime
	 * @return string
	 */
	public static function intime( $datetime )
	{
		// todo: исправить: полностью работать от карбона.
		$Carbon = Carbon::parse( $datetime );
		$Date   = $Carbon->format( 'Y-m-d' );
		$Time   = $Carbon->format( 'H:i' );
		if ( config( 'LFE.use_intime', false ) == true )
		{
			if ( $Date == date( 'Y-m-d' ) )
			{
				return trans( 'LFE::LFE.datetime.today', [ 'at' => $Time ] );
			}
			else
			{
				if ( $Date == date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ), date( 'd' ) - 1, date( 'Y' ) ) ) )
				{
					return trans( 'LFE::LFE.datetime.yesterday', [ 'at' => $Time ] );
				}
				else
				{
					return $Carbon->format( config( 'LFE.datetime.date.middle_datetime' ) );
				}
			}
		}

		return $Carbon->format( config( 'LFE.datetime.date.middle_datetime' ) );
	}

	/**
	 * prepare string to seo-readable addrees (url)
	 * @param string $str
	 * @return string
	 */
	public static function seoAddress( $str = '' )
	{
		$str = mb_strtolower( $str );
		$str = preg_replace( "/\W/u", "-", ( empty( $str )
			? ''
			: strtr( $str, trans( 'LFE::LFE.translit' ) ) ) );
		while ( mb_substr( $str, -1 ) == '-' )
		{
			$str = mb_substr( $str, 0, mb_strlen( $str ) - 1 );
		}

		return $str;
	}

	/**
	 * @return void
	 */
	public static function arr()
	{
		array_map( function ( $x )
		{
			( new Dumper )->dump( $x );
		}, func_get_args() );
	}

	/**
	 * @param int $forum_id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function makeNewTopicUrl( $forum_id )
	{
		return url( config( 'LFE.routes.prefix' ) . '/f-' . $forum_id . '/new-topic' );
	}

	/**
	 * @param $topic_id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function makeReplyUrl( $topic_id )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $topic_id . '/reply' );
	}

	/**
	 * @param $topic_id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function makeDeleteTopicUrl( $topic_id )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $topic_id . '/delete' );
	}

	/**
	 * @param $topic_id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function makeHideTopicUrl( $topic_id )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $topic_id . '/hide' );
	}

	/**
	 * @param $topic_id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function makeUnhideTopicUrl( $topic_id )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $topic_id . '/unhide' );
	}
}
