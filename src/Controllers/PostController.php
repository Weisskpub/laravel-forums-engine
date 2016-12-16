<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Post;
use Hzone\LFE\Model\Topic;
use Hzone\LFE\Satellite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class PostController
 * @package Hzone\LFE\Controllers
 */
class PostController extends Controller
{
	/**
	 * TopicController constructor.
	 * @param Request $request
	 */
	public function __construct( Request $request )
	{
		$this->request = $request;
	}

	/**
	 * @param $post_id
	 * @return \Illuminate\View\View
	 */
	public function getPost( $post_id )
	{
		$Post = Post::with( 'topic' )
			->find( $post_id )
		;
		if ( !empty( $Post ) )
		{
			$pageNum = $Post->findPostPage( $post_id );
			if ( !empty( $pageNum ) )
			{
				return redirect( Satellite::makeTopicUrl( $Post->topic ) . '?page=' . $pageNum . '#post-' . $post_id );
			}
		}
		else
		{
			return view( 'LFE::post.not-found' );
		}
	}

	/**
	 * @param $topic_id
	 * @return mixed
	 */
	public function getReply( $topic_id )
	{
		if ( Auth::check() )
		{
			if ( !empty( $topic_id ) )
			{
				$Topic = Topic::find( $topic_id );
				if ( !empty( $Topic ) )
				{
					return view( 'LFE::topic.reply', [ 'Topic' => $Topic ] );
				}
				else
				{
					return view( 'LFE::topic.not-found' );
				}
			}
			else
			{
				return view( 'LFE::topic.not-found' );
			}
		}
		else
		{
			return redirect( config( 'LFE.login_page' ) );
		}
	}

	public function postReply( $topic_id )
	{
		$message   = $this->request->get( 'message' );
		$Validator = Validator::make( [
			'message'  => $message,
			'topic_id' => $topic_id,
		], [
			'message'  => 'required|min:2',
			'topic_id' => 'required|integer',
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
			if ( !empty( $topic_id ) )
			{
				$Topic = Topic::find( $topic_id );
				if ( !empty( $Topic ) )
				{
					$Post = $Topic->posts()
						->create( [
							'user_id'   => Auth::user()->id,
							'is_active' => true,
							'message'   => $message,
							'ip'        => $this->request->ip(),
							'forum_id'  => $Topic->forum_id,
						] )
					;
					if ( $Post->exists() )
					{
						return redirect( Satellite::makeTopicUrl( $Topic ) . '#post-' . $Post->id );
					}
					else
					{
						return abort( 500 ); // todo: create error message
					}
				}
				else
				{
					return view( 'LFE::topic.not-found' );
				}
			}
			else
			{
				return view( 'LFE::topic.not-found' );
			}
		}
		else
		{
			return redirect( config( 'LFE.login_page' ) );
		}
	}
}
