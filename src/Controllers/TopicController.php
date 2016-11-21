<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Topic;

class TopicController extends Controller
{
	public function getTopic( $id )
	{
		$Topic = Topic::with( [
			'posts' => function ( $query )
			{
				return $query->with( 'user' )
					->paginate( config( 'LFE.paginate.posts' ) )
					;
			},
		] )
			->with( 'post', 'post.user', 'forum' )
			->find( $id )
		;

		//dd($Topic->toArray());
		return view( 'LFE.topic.index', [ 'Topic' => $Topic ] );
	}
}
