<?php

if ( config( 'app.debug' ) == true )
{
	\Artisan::call( 'view:clear' );
}

Route::group( [ 'middleware' => [ 'web' ] ], function ()
{
	// Permissions: Allow view to all
	Route::get( '/', 'IndexController@getIndex' );

	// Permissions: Allow <view forum> to group, assigned to forum
	Route::get( '/f-{fid}-{SEOforumName}', 'ForumController@getForum' );

	// Permissions: Allow <view forum> to group, assigned to forum
	Route::get( '/t-{tid}-{SEOtopicName}', 'TopicController@getTopic' );

	// Permissions: Allow <create> to group, assigned to forum
	Route::get( '/f-{fid}/new-topic', 'TopicController@getNew' );
	Route::post( '/f-{fid}/new-topic', 'TopicController@postNew' );

	// Permissions: Allow <reply> to group, assigned to forum
	Route::get( '/tc-{tid}/reply', 'PostController@getReply' );
	Route::post( '/t-{tid}/reply', 'PostController@postReply' );

	// Permissions: Allow <complaint> to group, assigned to forum
	Route::get( '/p-{pid}/complaint', 'PostController@getComplaint' );
	Route::post( '/p-{pid}/complaint', 'PostController@postComplaint' );

	// Permissions: Allow <like> to group, assigned to forum
	Route::post( '/p-{pid}/like', 'PostController@postLike' );
} );
