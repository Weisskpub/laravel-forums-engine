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
		\DB::table('lfe_forums')->delete();
		\DB::table('lfe_forums')->insert([
			['id' => 1,'parent_id' => 0,'title' => 'General Forum','description' => 'Single Forum','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 100,'user_id' => 1,'topic_id' => 5,'post_id' => 16,],
			['id' => 2,'parent_id' => 0,'title' => 'Forum-Category 1','description' => 'Forum with subforums. NOT able to meke topics in root category, only subforums','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => true,'is_active' => true,'rank' => 200,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 5,'parent_id' => 2,'title' => 'Subforum 1/1','description' => 'Normal forum under Forum-Category 1','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 100,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 6,'parent_id' => 2,'title' => 'Subforum 1/2','description' => 'Normal forum under Forum-Category 1','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 200,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 3,'parent_id' => 0,'title' => 'Forum-Category 2','description' => 'Forum with subforums. You able to meke topics in root category and subforums','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 300,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 7,'parent_id' => 3,'title' => 'Subforum 2/1','description' => 'Normal forum under Forum-Category 2','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 100,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 8,'parent_id' => 3,'title' => 'Subforum 2/2','description' => 'Normal forum under Forum-Category 2','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => true,'rank' => 200,'user_id' => null,'topic_id' => null,'post_id' => null,],
			['id' => 4,'parent_id' => 0,'title' => 'Hidden Forum','description' => 'Hidden forums can view only admins','keywords' => 'h-zone, Laravel, Forum, Engine','is_category' => false,'is_active' => false,'rank' => 400,'user_id' => null,'topic_id' => null,'post_id' => null,],
		]);
		
		\DB::table('lfe_topics')->insert([
			['id' => 1, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 01'],
			['id' => 2, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 02'],
			['id' => 3, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 03'],
			['id' => 4, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 04'],
			['id' => 5, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 05'],
			['id' => 6, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 06'],
			['id' => 7, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 07'],
			['id' => 8, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 08'],
			['id' => 9, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 09'],
			['id' => 10, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 10'],
			['id' => 11, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'views' => 0, 'title' => 'Topic 11'],
		]);
		
		\DB::table('lfe_posts')->insert([
			['id' => 1,'topic_id' => 1, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:00:00','updated_at' => '2016-11-21 21:00:00',],
			['id' => 2,'topic_id' => 2, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:05:00','updated_at' => '2016-11-21 21:05:00',],
			['id' => 3,'topic_id' => 3, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:10:00','updated_at' => '2016-11-21 21:10:00',],
			['id' => 4,'topic_id' => 4, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:15:00','updated_at' => '2016-11-21 21:15:00',],
			['id' => 5,'topic_id' => 5, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:20:00','updated_at' => '2016-11-21 21:20:00',],
			['id' => 6,'topic_id' => 6, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:25:00','updated_at' => '2016-11-21 21:25:00',],
			['id' => 7,'topic_id' => 7, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:30:00','updated_at' => '2016-11-21 21:30:00',],
			['id' => 8,'topic_id' => 8, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:35:00','updated_at' => '2016-11-21 21:35:00',],
			['id' => 9,'topic_id' => 9, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:40:00','updated_at' => '2016-11-21 21:40:00',],
			['id' => 10,'topic_id' => 10, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:45:00','updated_at' => '2016-11-21 21:45:00',],
			['id' => 11,'topic_id' => 11, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:50:00','updated_at' => '2016-11-21 21:50:00',],
			['id' => 12,'topic_id' => 10, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 21:55:00','updated_at' => '2016-11-21 21:55:00',],
			['id' => 13,'topic_id' => 10, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 22:00:00','updated_at' => '2016-11-21 22:00:00',],
			['id' => 14,'topic_id' => 10, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 22:10:00','updated_at' => '2016-11-21 22:10:00',],
			['id' => 15,'topic_id' => 5, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 22:15:00','updated_at' => '2016-11-21 22:15:00',],
			['id' => 16,'topic_id' => 5, 'forum_id' => 1, 'user_id' => 1, 'is_active' => true, 'body' => str_random(60),'created_at' => '2016-11-21 22:20:00','updated_at' => '2016-11-21 22:20:00', ],
		]);
		
	}
}

