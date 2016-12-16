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
					$return[] = $this->bctpl( Satellite::makeForumUrl( $this ), $this->title, true );
				}
				else
				{
					$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
					$return = $this->recursivelyPassForumsUp( $this->parent_id, $return );
					$return[] = $this->bctpl( Satellite::makeForumUrl( $this ), $this->title, true );
				}
				break;
			case 'Hzone\LFE\Model\Topic':
				$return[] = $this->bctpl( $base_url, trans( 'LFE::LFE.name' ) );
				$return = $this->recursivelyPassForumsUp( $this->forum_id, $return );
				$return[] = $this->bctpl( Satellite::makeTopicUrl( $this ), $this->title, true );
				break;
			case 'Hzone\LFE\Model\Post':
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
	 * @param bool $is_active
	 * @return string
	 */
	protected function bctpl( $url = null, $title = null, $is_active = false )
	{
		switch ( $is_active )
		{
			case false:
			default:
				return '<li><a href="' . $url . '">' . $title . '</a></li>';
				break;
			case true:
				return '<li class="active">' . $title . '</li>';
				break;
		}
	}
}