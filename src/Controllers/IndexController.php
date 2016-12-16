<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\FAggr;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;

/**
 * Class IndexController
 * @package Hzone\LFE\Controllers
 */
class IndexController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getIndex()
	{
		$defaultIndex = config( 'LFE.index' );
		switch ( $defaultIndex )
		{
			case 'summary':
			default:
			case 'forums':
				return $this->forums();
				break;
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	protected function forums()
	{
		$Forums = FAggr::with( [
			'childs' => function ( $query )
			{
				return $query->where( 'lfe_forums.parent_id', '=', 0 )
					->countPosts()
					->with( 'lastPost' )
					->with( 'childs' )
					->orderBy( config( 'LFE.orderby.forums.column' ), config( 'LFE.orderby.forums.direction' ) )
					;
			},
		] )
			->orderBy( config( 'LFE.orderby.faggrs.column' ), config( 'LFE.orderby.faggrs.direction' ) )
			->get()
		;

		return view( 'LFE::forums.index', [ 'Forums' => $Forums ] );
	}

	/**
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getForum( $id )
	{
		$Forum = Forum::with( [
			'childs' => function ( $query )
			{
				return $query->countPosts();
			},
		] )
			->countPosts()
			->find( $id )
		;
		if ( !empty( $Forum ) )
		{
			$Topics = $Forum->topics()
				->with( 'user' )
				->countPosts()
				->orderBy( config( 'LFE.orderby.topics.column' ), config( 'LFE.orderby.topics.direction' ) )
				->paginate( config( 'LFE.paginate.topics' ) )
			;

			return view( 'LFE::forum.index', [
				'Forum'  => $Forum,
				'Topics' => $Topics,
			] );
		}
		else
		{
			return view( 'LFE::forum.not-found' );
		}
	}

	/**
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getTopic( $id )
	{
		$Topic = Topic::with( 'forum' )
			->find( $id )
		;
		if ( !empty ( $Topic ) )
		{
			$Posts = $Topic->posts()
				->with( 'user' )
				->with( [
					'topic' => function ( $query )
					{
						return $query->countPosts();
					},
				] )
				->orderBy( config( 'LFE.orderby.posts.column' ), config( 'LFE.orderby.posts.direction' ) )
				->paginate( config( 'LFE.paginate.posts' ) )
			;
		}
		else
		{
			return view( 'LFE::topic.not-found' );
		}

		return view( 'LFE::topic.index', [
			'Topic' => $Topic,
			'Posts' => $Posts,
		] );
	}
}
