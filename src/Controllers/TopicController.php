<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;
use Hzone\LFE\Satellite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hzone\LFE\Request\ValidateNewTopic;

/**
 * Class TopicController
 * @package Hzone\LFE\Controllers
 */
class TopicController extends Controller
{

	/**
	 * @param $forum_id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getNew( $forum_id )
	{
		if ( Auth::check() )
		{
			if ( !empty( $forum_id ) )
			{
				$Forum = Forum::find( $forum_id );
				if ( !empty( $Forum ) )
				{
					return view( 'LFE::topic.new', [ 'Forum' => $Forum ] );
				}
				else
				{
					return view( 'LFE::forum.not-found' );
				}
			}
			else
			{
				return view( 'LFE::forum.not-found' );
			}
		}
		else
		{
			return redirect( config( 'LFE.login_page' ) );
		}
	}

	/**
	 * @param $forum_id
	 * @return mixed
	 */
	public function postNew( ValidateNewTopic $request )
	{
		if ( Auth::check() )
		{
			$forum_id  = $request->get( 'forum_id' );
			$title     = $request->get( 'title' );
			$message   = $request->get( 'message' );
			if ( !empty( $forum_id ) )
			{
				$Forum = Forum::find( $forum_id );
				if ( !empty( $Forum ) )
				{
					$Topic = $Forum->topics()
						->create( [
							'user_id'   => Auth::user()->id,
							'is_active' => true,
							'title'     => $title,
						] )
					;
					$Post  = $Topic->posts()
						->create( [
							'user_id'   => Auth::user()->id,
							'is_active' => true,
							'message'   => $message,
							'ip'        => $request->ip(),
							'forum_id'  => $forum_id,
						] )
					;
					if ( $Topic->exists() && $Post->exists() )
					{
						return redirect( Satellite::makeTopicUrl( $Topic ) );
					}
					else
					{
						return abort( 500 ); // todo: create error message
					}
				}
				else
				{
					return view( 'LFE::forum.not-found' );
				}
			}
			else
			{
				return view( 'LFE::forum.not-found' );
			}
		}
		else
		{
			return redirect( config( 'LFE.login_page' ) );
		}
	}

	/**
	 * @param $topic_id
	 * @return $this|\Illuminate\Http\JsonResponse
	 */
	public function getDelete( $topic_id )
	{
		$return = [ 'success' => false ];
		if ( Auth::check() )
		{
			$Topic = Topic::find( $topic_id );
			if ( !empty( $Topic ) )
			{
				if ( $Topic->user_id == Auth::user()->id
					 || Auth::user()
						 ->isForumsModerator()
					 || Auth::user()
						 ->isForumsAdmin()
				)
				{
					$return[ 'success' ] = true;
					$return[ 'html' ]    = trans( 'LFE::LFE.delete-topic-confirm' );

					return response()->json( $return );
				}
				else
				{
					return response()->json( [
						'success' => false,
						'error'   => trans( 'LFE::LFE.access-denied-not-yours' ),
					] );
				}
			}
			else
			{
				return response()->json( [
					'success' => false,
					'error'   => trans( 'LFE::LFE.topic-not-found' ),
				] );
			}
		}
		else
		{
			return response()->json( [
				'success' => false,
				'error'   => trans( 'LFE::LFE.unauthorised' ),
			] );
		}
	}

	/**
	 * @param $topic_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function postDelete( $topic_id )
	{
		if ( Auth::check() )
		{
			$Topic = Topic::with( 'forum' )
				->with( 'user' )
				->find( $topic_id )
			;
			$Forum = $Topic->forum;
			if ( !empty( $Topic ) )
			{
				if ( $Topic->user_id == Auth::user()->id
					 || Auth::user()
						 ->isForumsModerator()
					 || Auth::user()
						 ->isForumsAdmin()
				)
				{
					$Topic->delete();
					$return[ 'success' ] = true;
					$return[ 'data' ]    = Satellite::makeForumUrl( $Forum );

					return response()->json( $return );
				}
				else
				{
					return response()->json( [
						'success' => false,
						'error'   => trans( 'LFE::LFE.access-denied-not-yours' ),
					] );
				}
			}
			else
			{
				return response()->json( [
					'success' => false,
					'error'   => trans( 'LFE::LFE.topic-not-found' ),
				] );
			}
		}
		else
		{
			return response()->json( [
				'success' => false,
				'error'   => trans( 'LFE::LFE.unauthorised' ),
			] );
		}
	}
}
