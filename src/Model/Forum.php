<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	protected $table      = 'lfe_forums';
	public    $timestamps = false;

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
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childs()
	{
		return $this->hasMany( $this, 'parent_id' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( config( 'LFE.User' ) )->select( 'id', 'email', config( 'LFE.username_column' ) );
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
	public function topic()
	{
		return $this->hasOne( Topic::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function post()
	{
		return $this->hasOne( Post::class, 'id', 'post_id' );
	}

	/**
	 * get topics list ordered by related posts updated_at column
	 * @return Collection
	 */
	public function getTopics()
	{
		/**
		 * researched.
		 */
		$Post       = new Post;
		$Topic      = new Topic;

		$postTable  = $Post->getTable();
		$topicTable = $Topic->getTable();

		unset( $Post );
		unset( $Topic );

		return Topic::join( $postTable, $postTable.'.topic_id', '=', $topicTable.'.id' )
			->orderBy( config( 'LFE.orderby.topics.column'), config( 'LFE.orderby.topics.direction') )
			->select( $topicTable. '.*' )
			->with( 'post' )
			->with( 'user' )
			->where( $topicTable.'.forum_id', '=', $this->id )
			->paginate( config( 'LFE.paginate.topics' ) )
		;
	}

}
