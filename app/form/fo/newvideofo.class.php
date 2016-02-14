<?php

/**
 * New Video Form Object.
 * Validates and hold new video form data.
 * @author anza
 * @version 30-07-2011
 */
class NewVideoFO extends AbstractFO
{
	const LINK = 'link';
	
	private $link;
	
	protected function bind()
	{
		$this->link = $this->request->valueOf(self::LINK);
	}
	
	protected function validate()
	{
		FormValidator::validate($this->link, self::LINK, ValidationRules::URL);
	}

	public function getLink()
	{
	    return $this->link;
	}
}

?>