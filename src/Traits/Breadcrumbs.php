<?php
namespace Hzone\LFE\Traits;

use Hzone\LFE\Model\Forum;
use Hzone\LFE\Satellite;

/**
 * Class Breadcrumbs
 * @package Hzone\LFE\Traits
 */
trait Breadcrumbs
{
	/**
	 * @return string
	 */
	public function breadcrumbs()
	{
		$class    = get_class( $this );
		$base_url = url( config( 'LFE.routes.prefix' ) );
		$return   = [];
		switch ( $class )
		{
			case 'Hzone\LFE\Model\Forum':
				if ( $this->parent_id == 0 )
				{
					$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
					$return[] = $this->bctpl( null, $this->title );
				}
				else
				{
					$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
					$return = $this->recursivelyPassForumsUp( $this->parent_id, $return );
					$return[] = $this->bctpl( null, $this->title );
				}
				break;
			case 'Hzone\LFE\Model\Topic':
				$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
				$return = $this->recursivelyPassForumsUp( $this->forum_id, $return );
				$return[] = $this->bctpl( null, $this->title );
				break;
			case 'Hzone\LFE\Model\Post':
				break;
			case 'App\User':
				$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
				if ( !empty( $this->{$this->getKeyName()} ) && $this->exists() == true )
				{
					// i know about $this->getKey() = real id num
					$return[] = $this->bctpl( url( config( 'LFE.routes.prefix' ) . '/users' ), trans( 'LFE::LFE.users-title' ) );
					$return[] = $this->bctpl( null, $this->{config( 'LFE.username_column' )} );
				}
				else
				{
					$return[] = $this->bctpl( null, trans( 'LFE::LFE.users-title' ) );
				}
				break;
		}

		return $return;
	}

	/**
	 * @param $parent_id
	 * @param array $array
	 * @return array
	 */
	protected function recursivelyPassForumsUp( $parent_id, $array = [] )
	{
		$Forum = Forum::find( $parent_id );
		//dd($Forum->toArray());
		if ( !empty( $Forum ) )
		{
			if ( empty( $Forum->parent_id ) )
			{
				// last
				$array[] = $this->bctpl( Satellite::makeForumUrl( $Forum ), $Forum->title );
			}
			else
			{
				// go deeper
				$array = $this->recursivelyPassForumsUp( $Forum->parent_id, $array );
			}
		}

		return $array;
	}

	/**
	 * @param string $url
	 * @param string $title
	 * @return string
	 */
	protected function bctpl( $url = null, $title = null )
	{
		return view( 'LFE::._breadcrumb', [ 'url' => $url, 'title' => $title ] );
	}
}