<?php

/**
 * Register Form Object.
 * Validates and hold registration form data.
 * @author anza
 * @version 12-06-2011
 */
class RegisterFO extends AbstractFO
{
	const LOGIN = 'login';
	const FIRSTNAME = 'firstname';
	const LASTNAME = 'lastname';
	const EMAIL = 'email';
	const PASSWORD = 'password';
	const GENDER = 'gender';
	const YEAR = 'year';
	const MONTH = 'month';
	const DAY = 'day';
	const RULES = 'rules';
	
	private $login;
	private $firstname;
	private $lastname;
	private $email;
	private $password;
	private $gender;
	private $year;
	private $month;
	private $day;
	private $rules;
	
	protected function bind()
	{
		$this->login = $this->request->valueOf(self::LOGIN);
		$this->firstname = $this->request->valueOf(self::FIRSTNAME);
		$this->lastname = $this->request->valueOf(self::LASTNAME);
		$this->email = $this->request->valueOf(self::EMAIL);
		$this->password = $this->request->valueOf(self::PASSWORD);
		$this->gender = $this->request->valueOf(self::GENDER);
		$this->year = $this->request->valueOf(self::YEAR);
		$this->month = $this->request->valueOf(self::MONTH);
		$this->day = $this->request->valueOf(self::DAY);
		$this->rules = $this->request->valueOf(self::RULES);
	}
	
	protected function validate()
	{
		FormValidator::validate($this->login, self::LOGIN, ValidationRules::NAME);
		FormValidator::validate($this->firstname, self::FIRSTNAME, ValidationRules::NAME);
		FormValidator::validate($this->lastname, self::LASTNAME, ValidationRules::NAME);
		FormValidator::validate($this->email, self::EMAIL, ValidationRules::EMAIL);
		FormValidator::validate($this->password, self::PASSWORD, ValidationRules::PASS);
		FormValidator::validateDate($this->year, $this->month, $this->day);
		FormValidator::validate($this->gender, self::GENDER, ValidationRules::NAME);
		FormValidator::validate($this->rules, self::RULES, ValidationRules::TICK);
	}

	public function getLogin()
	{
	    return $this->login;
	}

	public function getFirstname()
	{
	    return $this->firstname;
	}

	public function getLastname()
	{
	    return $this->lastname;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function getPassword()
	{
	    return HashGenerator::generateMD5($this->password);
	}

	public function getGender()
	{
	    return $this->gender;
	}

	public function getRules()
	{
	    return $this->rules;
	}

	public function getBirthdate()
	{
	    return $this->year . DASH . $this->month . DASH . $this->day;
	}
}

?>