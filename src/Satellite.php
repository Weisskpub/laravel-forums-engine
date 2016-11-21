<?php
namespace Hzone\LFE;

use Carbon\Carbon;
use Hzone\LFE\Model\Forum;
use Hzone\LFE\Model\Post;
use Hzone\LFE\Model\Topic;

class Satellite
{
	/**
	 * @param \Hzone\LFE\Model\Forum $Forum
	 * @return string
	 */
	public static function makeForumUrl( Forum $Forum )
	{
		return url( config( 'LFE.routes.prefix' ) . '/f-' . $Forum->id . '-' . self::seoAddress( $Forum->title ) );
	}

	/**
	 * @param \Hzone\LFE\Model\Topic $Topic
	 * @return string
	 */
	public static function makeTopicUrl( Topic $Topic )
	{
		return url( config( 'LFE.routes.prefix' ) . '/t-' . $Topic->id . '-' . self::seoAddress( $Topic->title ) );
	}

	/**
	 * @param \Hzone\LFE\Model\Forum $Forum
	 * @return string
	 */
	public static function makeLastPostUrlF( Forum $Forum )
	{
		if ( $Topic = $Forum->topic )
		{
			return url( config( 'LFE.routes.prefix' ) . '/t-' . $Topic->id . '-' . self::seoAddress( $Forum->title ) . '#lastpost' );
		}
		return url( config( 'LFE.routes.prefix' ) );
	}

	/**
	 * @param \Hzone\LFE\Model\Topic $Topic
	 * @return string
	 */
	public static function makeLastPostUrlT( Topic $Topic )
	{
		if ( $Post = $Topic->post )
		{
			return url( config( 'LFE.routes.prefix' ) . '/t-' . $Topic->id . '-' . self::seoAddress( $Topic->title ) . '#lastpost' );
		}
		return url( config( 'LFE.routes.prefix' ) );
	}

	/**
	 * @param object $User
	 * @return string
	 */
	public static function makeUserUrl( $User )
	{
		if ( !empty( $User ) )
		{
			$name = self::seoAddress( $User->{config( 'LFE.username_column' )} );
			return url( config( 'LFE.routes.prefix' ) . '/user/' . $User->id . '-' . $name );
		}
		else
		{
			return url( config( 'LFE.routes.prefix' ) . '/users' );
		}
	}

	/**
	 * @param $datetime
	 * @return string
	 */
	public static function intime( $datetime )
	{
		// todo: исправить: полностью работать от карбона.
		$Carbon = Carbon::parse( $datetime );
		$Date   = $Carbon->format( 'Y-m-d' );
		$Time   = $Carbon->format( 'H:i' );
		if ( config( 'LFE.use_intime', false ) == true )
		{
			if ( $Date == date( 'Y-m-d' ) )
			{
				return trans( 'LFE.datetime.today', [ 'at' => $Time ] );
			}
			else
			{
				if ( $Date == date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ), date( 'd' ) - 1, date( 'Y' ) ) ) )
				{
					return trans( 'LFE.datetime.yesterday', [ 'at' => $Time ] );
				}
				else
				{
					return $Carbon->format( config( 'LFE.datetime.date.middle_datetime' ) );
				}
			}
		}
		return $Carbon->format( config( 'LFE.datetime.date.middle_datetime' ) );
	}

	/**
	 * convert any latin/cyrillic symbols to seo-optimized string (for address links)
	 * @param string $str
	 * @return string
	 */
	public static function seoAddress( $str = '' )
	{
		$str = preg_replace( "/\W/u", "", self::translit( mb_strtolower( $str ) ) );
		while ( mb_substr( $str, -1 ) == '-' )
		{
			$str = mb_substr( $str, 0, mb_strlen( $str ) - 1 );
		}
		return $str;
	}

	/**
	 * @param null $str
	 * @return string
	 */
	public static function translit( $str = null )
	{
		if ( empty( $str ) )
		{
			return '';
		}
		$converter = [
			'а' => 'a',
			'б' => 'b',
			'в' => 'v',
			'г' => 'g',
			'д' => 'd',
			'е' => 'e',
			'ё' => 'e',
			'ж' => 'zh',
			'з' => 'z',
			'и' => 'i',
			'й' => 'y',
			'к' => 'k',
			'л' => 'l',
			'м' => 'm',
			'н' => 'n',
			'о' => 'o',
			'п' => 'p',
			'р' => 'r',
			'с' => 's',
			'т' => 't',
			'у' => 'u',
			'ф' => 'f',
			'х' => 'h',
			'ц' => 'c',
			'ч' => 'ch',
			'ш' => 'sh',
			'щ' => 'sch',
			'ь' => '\'',
			'ы' => 'y',
			'ъ' => '\'',
			'э' => 'e',
			'ю' => 'yu',
			'я' => 'ya',
			'А' => 'A',
			'Б' => 'B',
			'В' => 'V',
			'Г' => 'G',
			'Д' => 'D',
			'Е' => 'E',
			'Ё' => 'E',
			'Ж' => 'Zh',
			'З' => 'Z',
			'И' => 'I',
			'Й' => 'Y',
			'К' => 'K',
			'Л' => 'L',
			'М' => 'M',
			'Н' => 'N',
			'О' => 'O',
			'П' => 'P',
			'Р' => 'R',
			'С' => 'S',
			'Т' => 'T',
			'У' => 'U',
			'Ф' => 'F',
			'Х' => 'H',
			'Ц' => 'C',
			'Ч' => 'Ch',
			'Ш' => 'Sh',
			'Щ' => 'Sch',
			'Ь' => '\'',
			'Ы' => 'Y',
			'Ъ' => '\'',
			'Э' => 'E',
			'Ю' => 'Yu',
			'Я' => 'Ya',
		];
		return strtr( $str, $converter );
	}

}