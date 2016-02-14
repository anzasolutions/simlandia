<?php

/**
 * Business logic of registration.
 * @author anza
 * @version 03-04-2011
 */
class RegisterModel extends AbstractModel
{
	/**
	 * Register new User.
	 * @param RegisterFO $fo
	 */
	public function register(RegisterFO $fo)
	{
		$user = $this->makeUser($fo);
		DAOFactory::getUserDAO()->save($user);
		$this->sendActivationLink($user);
	}
	
	/**
	 * Making new User to register.
	 * @param RegisterFO $fo
	 * @return User
	 */
	private function makeUser(RegisterFO $fo)
	{
		$user = new User();
		$user->setLogin($fo->getLogin());
		$user->setFirstname($fo->getFirstname());
		$user->setLastname($fo->getLastname());
		$user->setEmail($fo->getEmail());
		$user->setPassword($fo->getPassword());
		$user->setGender($fo->getGender());
		$user->setBirthdate($fo->getBirthdate());
		$user->setLatestIP(null);
		$user->setLastActive(null);
		$user->setActivation($this->makeActivationHash($user));
		return $user;
	}
	
	/**
	 * Making User activation hash.
	 * @param User $user
	 * @return string
	 */
	private function makeActivationHash(User $user)
	{
		return HashGenerator::generateMD5($user->getLogin() . $user->getEmail() . $user->getPassword());
	}
	
	/**
	 * Sends email with activation link.
	 * @param User $user
	 * @author anza
	 */
	private function sendActivationLink(User $user)
	{
		$subject = Bundle::get('register.mail.subject');
		$message = URL::getInstance()->getCustomActionURL('auth', 'activate') . SLASH . $user->getActivation();
		Mailer::send($user->getEmail(), $subject, $message);
	}
}

?>