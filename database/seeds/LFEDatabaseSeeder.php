<?php

use Illuminate\Database\Seeder;

class LFEDatabaseSeeder extends Seeder
{

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('lfe_forums')->insert([
			[
				'id'               => 1,
				'parent_id'        => 0,
				'title'            => 'General Forum',
				'description'      => 'Single Forum',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 100,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],
			[
				'id'               => 2,
				'parent_id'        => 0,
				'title'            => 'Forum-Category 1',
				'description'      => 'Forum with subforums. NOT able to meke topics in root category, only subforums',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => true,
				'is_active'        => true,
				'rank'             => 200,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],

			[
				'id'               => 5,
				'parent_id'        => 2,
				'title'            => 'Subforum 1/1',
				'description'      => 'Normal forum under Forum-Category 1',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 100,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],
			[
				'id'               => 6,
				'parent_id'        => 2,
				'title'            => 'Subforum 1/2',
				'description'      => 'Normal forum under Forum-Category 1',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 200,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],


			[
				'id'               => 3,
				'parent_id'        => 0,
				'title'            => 'Forum-Category 2',
				'description'      => 'Forum with subforums. You able to meke topics in root category and subforums',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 300,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],

			[
				'id'               => 7,
				'parent_id'        => 3,
				'title'            => 'Subforum 2/1',
				'description'      => 'Normal forum under Forum-Category 2',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 100,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],
			[
				'id'               => 8,
				'parent_id'        => 3,
				'title'            => 'Subforum 2/2',
				'description'      => 'Normal forum under Forum-Category 2',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => true,
				'rank'             => 200,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],

			[
				'id'               => 4,
				'parent_id'        => 0,
				'title'            => 'Hidden Forum',
				'description'      => 'Hidden forums can view only admins',
				'keywords'         => 'h-zone, Laravel, Forum, Engine',
				'is_category'      => false,
				'is_active'        => false,
				'rank'             => 400,
				'user_id'          => null,
				'topic_id'         => null,
				'post_id'          => null,
			],
		]);
		
		
	}
}

