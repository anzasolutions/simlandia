<?php

class User
{
	private $id = 0;
	private $login;
	private $password;
	private $firstname;
	private $lastname;
	private $email;
	private $online;
	private $gender;
	private $birthdate;
	private $avatar;
	private $active;
	private $visitNumber;
	private $lastActive;
	private $latestIP;
	private $activation;
	
	public function __construct()
	{
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setLogin($login)
	{
		$this->login = $login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

//	public function isOnline()
//	{
//		return $this->online;
//	}

	public function getOnline()
	{
		return $this->online;
	}

	public function setOnline($online)
	{
		$this->online = $online;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function setBirthdate($birthdate)
	{
		$this->birthdate = $birthdate;
	}

//	public function hasAvatar()
//	{
//		return $this->avatar;
//	}

	public function getAvatar()
	{
		return $this->avatar;
	}

	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
	}

//	public function isActive()
//	{
//		return $this->active;
//	}

	public function getActive()
	{
		return $this->active;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}

	public function getVisitNumber()
	{
		return $this->visitNumber;
	}

	public function setVisitNumber($visitNumber)
	{
		$this->visitNumber = $visitNumber;
	}

	public function getLastActive()
	{
		if ($this->lastActive == null)
			return Date::getNow();
		return $this->lastActive;
	}

	public function setLastActive($lastActive)
	{
		if ($lastActive == null)
			$lastActive = Date::getNow();
		$this->lastActive = $lastActive;
	}

	public function getLatestIP()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$ipDivided = explode(".", $ip);
		if (count($ipDivided) < 4)
			return '127.0.0.1';
		return $ip;
	}

	public function setLatestIP($latestIP)
	{
		$this->latestIP = $_SERVER['REMOTE_ADDR'];
	}

	public function getActivation()
	{
	    return $this->activation;
	}

	public function setActivation($activation)
	{
	    $this->activation = $activation;
	}
}

?>