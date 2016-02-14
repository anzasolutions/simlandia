<?php

/**
 * Login Form Object.
 * Validates and hold login form data.
 * @author anza
 * @version 12-06-2011
 */
class LoginFO extends AbstractFO
{
	const EMAIL = 'email';
	const PASSWORD = 'password';
	
	private $email;
	private $password;
	
	protected function bind()
	{
		$this->email = $this->request->valueOf(self::EMAIL);
		$this->password = $this->request->valueOf(self::PASSWORD);
	}
	
	protected function validate()
	{
		FormValidator::validate($this->email, self::EMAIL, ValidationRules::EMAIL);
		FormValidator::validate($this->password, self::PASSWORD, ValidationRules::PASS);
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function getPassword()
	{
	    return HashGenerator::generateMD5($this->password);
	}
}

?>