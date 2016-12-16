<?php
namespace Hzone\LFE\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Administrator
 * @package Hzone\LFE\Model
 */
class Rights extends Model
{
	protected $table    = 'lfe_rights';
	protected $hidden   = [
		'created_at',
		'updated_at',
	];
	protected $fillable = [
		'user_id',
		'forum_id',
		'is_admin',
		'is_moderator',
	];

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function user()
	{
		return $this->belongsToMany( User::class );
	}

	/**
	 * @return mixed
	 */
	protected function scopeAdmins()
	{
		return $this->where( 'is_admin', '=', true );
	}

	/**
	 * @return mixed
	 */
	protected function scopeModerators()
	{
		return $this->where( 'is_moderator', '=', true );
	}

	/**
	 * @return array|null
	 */
	public function getAdmins()
	{
		return $this->admins()
			->distinct( 'user_id' )
			->get()
			;
	}

	public function getModerators()
	{
		return $this->admins()
			->select( 'user_id', 'forum_id' )
			->get()
			;
	}
}
