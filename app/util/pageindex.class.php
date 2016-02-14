<?php

/**
 * Handle pages index.
 * @author anza
 * @version 19-07-2011
 */
abstract class PageIndex
{
	const ZERO = 0; 
	const ONE = 1; 
	
	public static function make($pages)
	{
		$url = URL::getInstance();
		$zero = $url->getParameter(self::ZERO);
		$one = $url->getParameter(self::ONE);
		
		$pageIndex = '';
		for ($i = self::ONE; $i <= intval($pages); $i++)
		{
			$link = DOMFactory::getLink($url->getParamURL(array($zero, $i)), $i);
			if ($i == $one || ($one == null && $i == self::ONE))
			{
				$link = $i;
			}
			$pageIndex .= $link . SPACE;
		}
		
		return $pageIndex;
	}
}

?>