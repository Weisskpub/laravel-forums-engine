<?php
if ( config( 'app.debug' ) == true )
{
	\Artisan::call( 'view:clear' );
}
Route::group( [ 'middleware' => [ 'web' ] ], function ()
{
	Route::get( '/js', function ()
	{
		return view( 'LFE::js' );
	} );
	Route::get( '/app.js', function ()
	{
		$content  = \View::make( 'LFE._ready_js' );
		$response = \Response::make( $content );
		$response->header( 'Content-Type', 'application/javascript' );

		return $response;
	} );
	// Permissions: Allow view to all
	Route::get( '/', 'IndexController@getIndex' );
	// Permissions: Allow <view forum> to group, assigned to forum
	Route::get( '/f-{fid}-{SEOforumName}', 'IndexController@getForum' );
	// Permissions: Allow <view forum> to group, assigned to forum
	Route::get( '/t-{tid}-{SEOtopicName}', 'IndexController@getTopic' );
	// Get topic/post by post
	Route::get( '/p-{pid}', 'PostController@getPost' );


	// Permissions: Allow <create> to group, assigned to forum
	Route::get( '/f-{fid}/new-topic', 'TopicController@getNew' );
	Route::post( '/f-{fid}/new-topic', 'TopicController@postNew' );
	// Permissions: Allow <reply> to group, assigned to forum
	Route::get( '/t-{tid}/reply', 'PostController@getReply' );
	Route::post( '/t-{tid}/reply', 'PostController@postReply' );
	// Permissions: Allow <reply> to group, assigned to forum
	Route::get( '/t-{tid}/delete', 'TopicController@getDelete' );
	Route::post( '/t-{tid}/delete', 'TopicController@postDelete' );
	// Permissions: Allow <complaint> to group, assigned to forum
	//Route::get( '/p-{pid}/complaint', 'PostController@getComplaint' );
	//Route::post( '/p-{pid}/complaint', 'PostController@postComplaint' );
	// Permissions: Allow <like> to group, assigned to forum
	//Route::post( '/p-{pid}/like', 'PostController@postLike' );
} );
