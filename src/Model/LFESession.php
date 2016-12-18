<?php
namespace Hzone\LFE\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * ReadOnly
 * @package Hzone\LFE\Model
 */
class LFESession extends Model
{
	protected $table        = 'sessions';
	protected $hidden       = [ 'payload' ];
	public    $incrementing = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( config( 'LFE.User' ) );
	}
}
