<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Forum;

class ForumController extends Controller
{
	public function getForum( $id )
	{
		$Forum = Forum::with( [
			'topics' => function ( $query )
			{
				return $query->with( 'post' )
					->with( 'user' )
					->paginate( config( 'LFE.paginate.topics' ) )
					;
			},
		], 'childs' )
			->find( $id )
		;

		//dd($Forum->toArray());
		return view( 'LFE.forum.index', [ 'Forum' => $Forum ] );
	}
}
