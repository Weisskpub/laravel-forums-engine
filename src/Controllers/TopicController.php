<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;
use Hzone\LFE\Satellite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class TopicController
 * @package Hzone\LFE\Controllers
 */
class TopicController extends Controller
{
	protected $request = null;
	protected $auth    = null;

	/**
	 * TopicController constructor.
	 * @param Request $request
	 */
	public function __construct( Request $request )
	{
		$this->request = $request;
	}

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
	public function postNew( $forum_id )
	{
		$title     = $this->request->get( 'title' );
		$message   = $this->request->get( 'message' );
		$Validator = Validator::make( [
			'title'    => $title,
			'message'  => $message,
			'forum_id' => $forum_id,
		], [
			'title'    => 'required|min:4|max:160',
			'message'  => 'required|min:2',
			'forum_id' => 'required|integer',
		] );
		if ( $Validator->fails() )
		{
			$this->request->flash();

			return redirect()
				->back()
				->withErrors( $Validator->errors() )
				;
		}
		//....
		if ( Auth::check() )
		{
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
							'ip'        => $this->request->ip(),
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
