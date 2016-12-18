<?php
namespace Hzone\LFE\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
	public function getIndex()
	{
		return view(
			'LFE::user.index',
			[
				'Users'  => User::paginate( config( 'LFE.paginate.users' ) ),
				'Target' => config( 'LFE.UserClass' )
			]
		);
	}
	public function getUser( $user_id )
	{
		$User = User::find( $user_id );
		if ( !is_null( $User ) )
		{
			return view('LFE::user.user', [ 'User' => $User ] );
		}
		else
		{
			return view( 'LFE::user.not-found' );
		}
	}
}
