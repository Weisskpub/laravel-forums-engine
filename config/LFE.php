<?php
return [
	/**
	 * Use HTPPS only (adopts URLs to force using https://
	 */
	'https' => true,
	/**
	 * Version
	 */
	'version'                => '0.2',
	/**
	 * What to show in index by default
	 * See IndexController
	 */
	'index'                  => 'forums',
	/**
	 * Routes prefix
	 * i.e: domina.com/forums
	 */
	'routes'                 => [
		'prefix' => 'forums',
	],
	/**
	 * User Model
	 */
	'User'                   => \App\User::class,
	/**
	 * User Class
	 */
	'UserClass'              => '\App\User',
	/**
	 * username from user model
	 */
	'username_column'        => 'name',
	/**
	 * order by for outup
	 * ->orderBy( config( 'LFE.orderby.forums.column'), config( 'LFE.orderby.forums.direction') )
	 * ->orderBy( config( 'LFE.orderby.topics.column'), config( 'LFE.orderby.topics.direction') )
	 * ->orderBy( config( 'LFE.orderby.posts.column'), config( 'LFE.orderby.posts.direction') )
	 */
	'orderby'                => [
		'faggrs' => [
			'column'    => 'rank',
			'direction' => 'ASC',
		],
		'forums' => [
			'column'    => 'rank',
			'direction' => 'ASC',
		],
		'topics' => [
			'column'    => 'updated_at',
			'direction' => 'DESC',
		],
		'posts'  => [
			'column'    => 'id',
			'direction' => 'ASC',
		],
	],
	/**
	 * use Today/Yesterday for dates ?
	 */
	'use_intime'             => true,
	/**
	 * formats for localized date and/or time
	 */
	'datetime'               => [
		'strftime' => [
			'long_datetime'  => '%A, %e %B %Y %H:%M',
			'short_datetime' => '%e %m %Y %H:%M',
			'long_date'      => '%A, %e %B %Y',
			'short_date'     => '%e %m %Y',
			'time'           => '%H:%M',
		],
		'date'     => [
			'long_datetime'   => 'l, j F Y H:i',
			'middle_datetime' => 'D, j M Y H:i',
			'short_datetime'  => 'd m Y H:i',
			'long_date'       => 'l, j F Y',
			'middle_date'     => 'j F Y',
			'short_date'      => 'd M Y',
			'time'            => 'H:i',
		],
	],
	/**
	 * pagination
	 */
	'paginate'               => [
		'topics' => 10,
		'posts'  => 10,
		'users'  => 10,
	],
	/**
	 * Session activity limit (in minutes)
	 */
	'activity_limit'         => 15,
	/**
	 * Default pages to login and register users
	 * Need to redirect unauthorized users before posting
	 */
	'login_page'             => url( '/login' ),
	'register_page'          => url( '/register' ),
	/**
	 * Some guest restrictions
	 * TODO: implementing
	 */
	'allow_guests_reply'     => false,
	'allow_guests_new_topic' => false,
];
