<?php

use Illuminate\Database\Seeder;
use Hzone\LFE\Model\FAggr;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Topic;
use Hzone\LFE\Model\Post;


class LFEDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('lfe_faggrs')->delete();
		DB::table('users')->whereIn('email',['admin@admin.com','moderator@moderator.com'])->delete();
		
		$User1 = App\User::create([
			'name'     => 'iAdmin',
			'email'    => 'admin@admin.com',
			'password' => '$2y$10$SgWTGun9TGxEMbe9SgVgnurwolpQ0sjjV6iYjmyVMJdZetckZhy4O', // 111111
		]);
		$User2 = App\User::create([
			'name'     => 'iModerator',
			'email'    => 'moderator@moderator.com',
			'password' => '$2y$10$SgWTGun9TGxEMbe9SgVgnurwolpQ0sjjV6iYjmyVMJdZetckZhy4O', // 111111
		]);

		$Faggr1             = FAggr::create(['rank'=>100,'is_active'=>true,'title'=>'Forums Group 1']);
		$Faggr2             = FAggr::create(['rank'=>200,'is_active'=>true,'title'=>'Forums Group 2']);
		$InactiveFaggr3     = FAggr::create(['rank'=>300,'is_active'=>false,'title'=>'Inactive (hidden) Forums Group 3']);

		$RootForum1         = $Faggr1->forums()->create([
			'rank'        => 100,
			'is_category' => false,
			'title'       => 'General Forum',
			'description' => 'This is a normal Forum',
		]);
		$RootForum2         = $Faggr1->childs()->create([
			'rank'        => 200,
			'is_category' => true,
			'title'       => 'Another Forum',
			'description' => 'This is a Category Forum (Posts not allowed in category)',
		]);
			$SubForum2_1      = $RootForum2->childs()->create([
				'f_aggr_id'   => $Faggr1->id,
				'rank'        => 100,
				'is_category' => false,
				'title'       => 'Another Forum Sub.1',
				'description' => 'This is a SubForum 1 of Another Forum',
			]);
			$SubForum2_2      = $RootForum2->childs()->create([
				'f_aggr_id'   => $Faggr1->id,
				'rank'        => 200,
				'is_category' => false,
				'title'       => 'Another Forum Sub.2',
				'description' => 'This is a SubForum 1 of Another Forum',
			]);
		$RootForum3         = $Faggr2->childs()->create([
			'rank'        => 100,
			'is_category' => false,
			'title'       => 'Third Forum',
			'description' => 'This is a Forum with subforums',
		]);
			$SubForum3_1      = $RootForum3->childs()->create([
				'f_aggr_id'   => $Faggr2->id,
				'rank'        => 100,
				'is_category' => false,
				'title'       => 'Third Forum Sub.1',
				'description' => 'This is a SubForum 1 of Third Forum',
			]);
			$SubForum3_2      = $RootForum3->childs()->create([
				'f_aggr_id'   => $Faggr2->id,
				'rank'        => 200,
				'is_category' => false,
				'title'       => 'Third Forum Sub.2',
				'description' => 'This is a SubForum 1 of Third Forum',
			]);

		$Topic1 = $RootForum1->topics()->create([
			'user_id'   => $User1->id,
			'is_active' => true,
			'title'     => 'Welcome!',
		]);
			$Post = $Topic1->posts()->create([
				'user_id'   => $User1->id,
				'is_active' => true,
				'ip'        => '123.45.67.89',
				'message'   => '
Look the source at https://github.com/h-zone/laravel-forums-engine !

[size=6]Base Formatting[/size]
[b]BOLD[/b]
[i]ITALIC[/i]
[u]UNDERLINE[/u]
[s]STRIKEOUT[/s]
[color=#ff0000][b]STRIKEOUT[/b][/color]
[url=https://www.google.com]Named Link (www.google.com[/url]
Just link: [url]https://www.google.com/[/url]

And more at https://github.com/golonka/bbcodeparser !

',
			]);
		$Topic2 = $RootForum1->topics()->create([
			'user_id'   => $User1->id,
			'is_active' => true,
			'title'     => 'Just for test 0001',
		]);
			$Post = $Topic2->posts()->create([
				'user_id'   => $User1->id,
				'is_active' => true,
				'ip'        => '123.45.67.89',
				'message'   => 'test',
			]);
		$Topic3 = $RootForum1->topics()->create([
			'user_id'   => $User2->id,
			'is_active' => true,
			'title'     => 'Just for test 0002',
		]);
			$Post = $Topic3->posts()->create([
				'user_id'   => $User2->id,
				'is_active' => true,
				'ip'        => '234.56.78.90',
				'message'   => 'test',
			]);
		$Topic4 = $RootForum1->topics()->create([
			'user_id'   => $User2->id,
			'is_active' => true,
			'title'     => 'Just for test 0003',
		]);
			$Post = $Topic4->posts()->create([
				'user_id'   => $User2->id,
				'is_active' => true,
				'ip'        => '234.56.78.90',
				'message'   => 'test',
			]);
		$Topic5 = $SubForum3_1->topics()->create([
			'user_id'   => $User1->id,
			'is_active' => true,
			'title'     => 'Just for test 0004',
		]);
			$Post = $Topic5->posts()->create([
				'user_id'   => $User1->id,
				'is_active' => true,
				'ip'        => '123.45.67.89',
				'message'   => 'test',
			]);

		$Rights1 = $User1->rights()->create([
			'is_admin'     => true,
			'is_moderator' => false,
		]);

		$Rights2 = $User2->rights()->create([
			'is_admin'     => false,
			'is_moderator' => true,
		]);

	}
}
