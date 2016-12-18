<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Request\ValidateReply;
use Hzone\LFE\Model\Post;
use Hzone\LFE\Model\Topic;
use Hzone\LFE\Satellite;

/**
 * Class PostController
 * @package Hzone\LFE\Controllers
 */
class PostController extends Controller
{
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
		if ( auth()->check() )
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

	public function postReply( ValidateReply $request )
	{
		if ( auth()->check() )
		{
			$message   = $request->get( 'message' );
			$topic_id  = $request->get( 'topic_id' );
			if ( !empty( $topic_id ) )
			{
				$Topic = Topic::find( $topic_id );
				if ( !empty( $Topic ) )
				{
					$Post = $Topic->posts()
						->create( [
							'user_id'   => auth()->user()->id,
							'is_active' => true,
							'message'   => $message,
							'ip'        => Satellite::ip(),
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
