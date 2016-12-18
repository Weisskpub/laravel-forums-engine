<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Hzone\LFE\Scopes\AllScope;
use Hzone\LFE\Traits\Breadcrumbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Forum
 * @package Hzone\LFE\Model
 */
class Forum extends Model
{
	use Breadcrumbs;
	protected $table  = 'lfe_forums';
	protected $hidden = [
		'created_at',
	];

	/**
	 * The "booting" method of the model.
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope( new ActiveScope );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function forum()
	{
		return $this->belongsTo( $this, 'id', null, 'childs' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childs()
	{
		return $this->hasMany( $this, 'parent_id' )
			->with( 'lastPost' )
			;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function forums()
	{
		return $this->childs();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( config( 'LFE.User' ) );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function topics()
	{
		return $this->hasMany( Topic::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function lastPost()
	{
		return $this->hasOne( Post::class, 'id', 'last_post' )
			->with( 'user' )
			->with( 'topic' )
			;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function posts()
	{
		return $this->hasManyThrough( Post::class, Topic::class );
	}

	/**
	 * @param array $array
	 * @return array
	 */
	public function recursivelyGetForumsDown( $array = [] )
	{
		$array[] = $this->id;
		$Forums  = $this->newQuery()
			->where( 'parent_id', '=', $this->id )
			->select( 'id', 'parent_id' )
			->get()
		;
		if ( count( $Forums ) )
		{
			foreach ( $Forums as $Forum )
			{
				$array = $Forum->recursivelyGetForumsDown( $array );
			}
		}

		return $array;
	}

	/**
	 * @param array $array
	 * @return array
	 */
	public function recursivelyGetForumsUp( $array = [] )
	{
		$array[] = $this->id;
		if ( !empty( $this->parent_id ) )
		{
			$next = Forum::find( $this->parent_id );
			if ( !empty( $next ) )
			{
				$array = $next->recursivelyGetForumsUp( $array );
			}
		}

		return $array;
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
		return $query->leftJoin( 'lfe_posts', 'lfe_posts.forum_id', '=', 'lfe_forums.id' )
			->selectRaw( 'lfe_forums.*, count(lfe_posts.id) as count_posts' )
			->groupBy( 'lfe_forums.id' )
			;
	}
}
