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
		return response( view( 'LFE._ready_js' ) )->header( 'Content-Type', 'application/javascript' );
	} );
	// Index page
	Route::get( '/', 'IndexController@getIndex' );
	// Forum page
	Route::get( '/f-{fid}-{SEOforumName}', 'IndexController@getForum' );
	Route::get( '/f-{fid}', 'IndexController@getForum' );
	// Topic page
	Route::get( '/t-{tid}-{SEOtopicName}', 'IndexController@getTopic' );
	Route::get( '/t-{tid}', 'IndexController@getTopic' );
	// Post to Topic/page/anchor Redirector
	Route::get( '/p-{pid}', 'PostController@getPost' );

	// New topic page
	Route::get( '/f-{fid}/new-topic', 'TopicController@getNew' );
	// New topic store
	Route::post( '/new-topic', 'TopicController@postNew' );
	// Reply page
	Route::get( '/t-{tid}/reply', 'PostController@getReply' );
	// Reply store
	Route::post( '/reply', 'PostController@postReply' );
	// Delete Topic
	Route::get( '/t-{tid}/delete', 'TopicController@getDelete' );
	// Delete Topic delete
	Route::post( '/t-{tid}/delete', 'TopicController@postDelete' );

} );
