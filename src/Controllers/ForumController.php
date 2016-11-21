<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;

class ForumController extends Controller
{
	public function getForum( $id )
	{
		$Forum = Forum::with( 'topic' )
			->with( 'post' )
			->with( 'user' )
			->with( 'childs' )
			->find( $id );
		$Topics = $Forum->getTopics();
		return view( 'LFE.forum.index', [ 'Forum' => $Forum, 'Topics' => $Topics ] );
	}
}
