<?php

/**
 * Recover Form Object.
 * Validates and hold recover form data.
 * @author anza
 * @version 18-06-2011
 */
class RecoverFO extends AbstractFO
{
	const EMAIL = 'email';
	
	private $email;
	
	protected function bind()
	{
		$this->email = $this->request->valueOf(self::EMAIL);
	}
	
	protected function validate()
	{
		FormValidator::validate($this->email, self::EMAIL, ValidationRules::EMAIL);
	}

	public function getEmail()
	{
	    return $this->email;
	}
}

?>