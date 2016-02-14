<?php

/**
 * Create DAO objects.
 * @author anza
 * @version 20-08-2011
 */
final class DAOFactory
{
	private function __construct()
	{
	}
	
	// TODO: have to handle incorrect $type!
	private static function getDAO($type)
	{
		$dao = $type.DAO;
		return new $dao($type);
	}
	
	// TODO: have to handle incorrect $type!
	// TODO: improve the name?
	// TODO: is this really needed? look here: http://stackoverflow.com/questions/6516230/is-it-ok-to-make-a-dao-class-as-singleton
	public static function getSingleInstanceDAO($type)
	{
		$dao = $type.DAO;
		return $dao->getInstance($type);
	}
	
	public static function getCommentDAO()
	{
		return self::getDAO('Comment');
	}
	
	public static function getUserDAO()
	{
		return self::getDAO('User');
	}
	
	public static function getVideoDAO()
	{
		return self::getDAO('Video');
	}
	
	public static function getVideoTypeDAO()
	{
		return self::getDAO('VideoType');
	}
}

?>