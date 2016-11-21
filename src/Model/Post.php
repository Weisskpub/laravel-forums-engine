<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table   = 'lfe_posts';
	protected $touches = [
		'topic',
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
			->select( 'id', 'email', config( 'LFE.username_column' ), 'created_at' )
			;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function topic()
	{
		return $this->belongsTo( Topic::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function forum()
	{
		return $this->belongsTo( Topic::class )
			->forum()
			;
	}
}
