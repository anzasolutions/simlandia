<?php

/**
 * Handle activities withn application scopes.
 * @author anza
 * @since 16-10-2010
 */
abstract class Scope
{
	const SESSION = 'session';
	const REQUEST = 'request';
	const APPLICATION = 'application';
	
	/**
	 * Get current application scope.
	 * @author anza
	 * @return string
	 */
	public static function current()
	{
		return Session::getInstance()->isStarted() ? self::SESSION : self::REQUEST;
	}
	
	/**
	 * Check whether provided scope is acceptable.
	 * @author anza
	 * @param string $scope
	 * @return boolean
	 */
	public static function isAcceptable($scope)
	{
		return $scope == self::APPLICATION || $scope == self::current() ? true : false;
	}
}

?>