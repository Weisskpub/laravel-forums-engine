<?php
namespace Hzone\LFE\Model;

use Hzone\LFE\Scopes\ActiveScope;
use Hzone\LFE\Scopes\AllScope;
use Hzone\LFE\Traits\Breadcrumbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class FAggr
 * @package Hzone\LFE\Model
 */
class FAggr extends Model
{
	use Breadcrumbs;
	protected $table = 'lfe_faggrs';
	public    $timestamps = false;

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
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childs()
	{
		return $this->hasMany( Forum::class );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function forums()
	{
		return $this->childs();
	}
}
