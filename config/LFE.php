<?php
return [


	/*
	 * What to show in index by default
	 * See IndexController
	 */
	'index' => 'forums',


	/*
	 * Routes prefix
	 * i.e: domina.com/forums
	 */
	'routes' => [
		'prefix' => 'forums',
	],


	/*
	 * User Model
	 */
	'User' => \App\User::class,


	/*
	 * username from user model
	 */
	'username_column' => 'name',


	/*
	 * order by for outup
	 */
	'orderby' => [
		'forums' => [						// ->orderBy( config( 'LFE.orderby.forums.column'), config( 'LFE.orderby.forums.direction') )
			'column'	=> 'rank',
			'direction' => 'ASC',
		],
		'topics' => [						// ->orderBy( config( 'LFE.orderby.topics.column'), config( 'LFE.orderby.topics.direction') )
			'column'	=> 'updated_at',
			'direction' => 'DESC',
		],
		'posts' => [						// ->orderBy( config( 'LFE.orderby.posts.column'), config( 'LFE.orderby.posts.direction') )
			'column'	=> 'id',
			'direction' => 'ASC',
		],
	],


	/*
	 * use Today/Yesterday for dates ?
	 */
	'use_intime' => true,


	/*
	 * formats for localized date and/or time
	 */
	'datetime'		=> [
		'strftime' => [
			'long_datetime'  => '%A, %e %B %Y %H:%M',
			'short_datetime' => '%e %m %Y %H:%M',
			'long_date'	  => '%A, %e %B %Y',
			'short_date'	 => '%e %m %Y',
			'time'		   => '%H:%M',
		],
		'date'	 => [
			'long_datetime'  => 'l, j F Y H:i',
			'middle_datetime'  => 'D, j M Y H:i',
			'short_datetime' => 'd m Y H:i',
			'long_date'	  => 'l, j F Y',
			'short_date'	 => 'd m Y',
			'time'		   => 'H:i',
		],
	],


	/**
	 * pagination
	 */
	'paginate' => [
		'topics' => 10,
		'posts' => 10,
	],
];
