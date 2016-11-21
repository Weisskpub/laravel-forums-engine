<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	protected $table   = 'lfe_topics';
	public    $timestamps = false;
	protected $touches = [
		'forum',
	];

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		// todo: if not admin
		static::addGlobalScope( new ActiveScope );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( config( 'LFE.User' ) )
			;
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
	public function post()
	{
		return $this->hasOne( Post::class )
			->orderBy( 'updated_at', 'desc' )
			;
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
	public function orderablePosts()
	{
		return $this->hasMany( Post::class )
			->orderBy( config( 'LFE.orderby.posts.column' ), config( 'LFE.orderby.posts.direction' ) )
			;
	}

}
