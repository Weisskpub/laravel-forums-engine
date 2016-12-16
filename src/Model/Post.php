<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Hzone\LFE\Scopes\AllScope;
use Hzone\LFE\Traits\PostTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Post
 * @package Hzone\LFE\Model
 */
class Post extends Model
{
	use PostTrait;
	protected $table    = 'lfe_posts';
	protected $fillable = [
		'user_id',
		'forum_id',
		'is_active',
		'message',
		'ip',
	];

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		if ( Auth::check()
			 && ( Auth::user()
					  ->isForumsAdmin()
				  || Auth::user()
					  ->isForumsAdmin() )
		)
		{
			static::addGlobalScope( new AllScope );
		}
		else
		{
			static::addGlobalScope( new ActiveScope );
		}
		static::created( function ( $Model )
		{
			$Model->updatedPost( $Model );
		} );
		static::updated( function ( $Model )
		{
			$Model->updatedPost( $Model );
		} );
		static::deleting( function ( $Model )
		{
			$Model->deletingPost( $Model );
		} );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( config( 'LFE.User' ) );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function topic()
	{
		return $this->belongsTo( Topic::class );
	}

	/**
	 * @param $post_id
	 * @return int|null
	 */
	public function findPostPage( $post_id )
	{
		$Topic   = $this->topic;
		$perPage = config( 'LFE.paginate.posts' );
		$Posts   = $Topic->posts4count()
			->orderBy( config( 'LFE.orderby.posts.column' ), config( 'LFE.orderby.posts.direction' ) )//->paginate( $perPage )
			->get()
		;
		$page    = 0;
		foreach ( $Posts as $x => $Post )
		{
			if ( $x % $perPage == 0 )
			{
				$page++;
			}
			if ( $Post->id == $post_id )
			{
				return $page;
			}
		}

		return null;
	}
}
