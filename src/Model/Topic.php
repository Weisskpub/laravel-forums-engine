<?php
namespace Hzone\LFE\Model;

use App\User;
use Hzone\LFE\Scopes\ActiveScope;
use Hzone\LFE\Scopes\AllScope;
use Hzone\LFE\Traits\Breadcrumbs;
use Hzone\LFE\Traits\TopicTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Topic
 * @package Hzone\LFE\Model
 */
class Topic extends Model
{
	use Breadcrumbs;
	use TopicTrait;
	protected $table    = 'lfe_topics';
	protected $fillable = [
		'user_id',
		'is_active',
		'title',
		'last_post',
	];

	/**
	 * The "booting" method of the model.
	 *
	 * @param User $User
	 * @return void
	 */
	protected static function boot( )
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
		static::deleting( function ( $Model )
		{
			$Model->deletingTopic( $Model );
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
	public function forum()
	{
		return $this->belongsTo( Forum::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts()
	{
		return $this->hasMany( Post::class )
			->orderBy( config( 'LFE.orderby.posts.column' ), config( 'LFE.orderby.posts.direction' ) )
			;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts4count()
	{
		return $this->hasMany( Post::class )
			->selectRaw( 'id' )
			->orderBy( config( 'LFE.orderby.posts.column' ), config( 'LFE.orderby.posts.direction' ) )
			;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function lastPost()
	{
		return $this->hasOne( Post::class, 'id', 'last_post' )
			->with( 'user' )
			;
	}

	/**
	 * @return int
	 */
	public function getCountPostsAttribute()
	{
		return ( !empty( $this->attributes[ 'count_posts' ] ) )
			? $this->attributes[ 'count_posts' ]
			: 0;
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeCountPosts( $query )
	{
		return $query->leftJoin( 'lfe_posts', 'lfe_posts.topic_id', '=', 'lfe_topics.id' )
			->selectRaw( 'lfe_topics.*, count(lfe_posts.id) AS count_posts' )
			->groupBy( 'lfe_topics.id' )
			;
	}
}
