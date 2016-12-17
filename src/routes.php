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

	Route::get( '/', 'IndexController@getIndex' );
	Route::get( '/f-{fid}-{SEOforumName}', 'IndexController@getForum' );
	Route::get( '/t-{tid}-{SEOtopicName}', 'IndexController@getTopic' );
	Route::get( '/p-{pid}', 'PostController@getPost' );


	Route::get( '/f-{fid}/new-topic', 'TopicController@getNew' );
	Route::post( '/new-topic', 'TopicController@postNew' );
	Route::get( '/t-{tid}/reply', 'PostController@getReply' );
	Route::post( '/reply', 'PostController@postReply' );
	Route::get( '/t-{tid}/delete', 'TopicController@getDelete' );
	Route::post( '/t-{tid}/delete', 'TopicController@postDelete' );

} );
