<?php

namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use Hzone\LFE\Model\Forum;

class IndexController extends Controller
{
	public function getIndex()
	{
		$defaultIndex = config( 'LFE.index' );
		switch( $defaultIndex )
		{
			case 'summary':
			default:
			case 'forums':
				return $this->forums();
			break;
		}
	}

	/**
	 * @return Response
	 */
	public function forums()
	{
		$Forums = Forum::where( 'is_active', '=', true )
			->where( 'parent_id', '=', '0' )
			->with( 'childs' )
			->with( 'user' )
			->with( 'topic' )
			->with( 'post' )
			->orderBy( config( 'LFE.orderby.forums.column' ), config( 'LFE.orderby.forums.direction' ) )
			->get();
		//dd($Forums->toArray());
		return view( 'LFE.forums.index', [ 'Forums' => $Forums ] );
	}
}
