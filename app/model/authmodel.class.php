<?php

/**
 * Contain authentication business logic.
 * @author anza
 * @version 27-11-2010
 */
class AuthModel extends AbstractModel
{
	/**
	 * Login validated user.
	 * @param LoginFO $fo
	 * @return User $user
	 */
	public function login(LoginFO $fo)
	{
		$user = DAOFactory::getUserDAO()->findByEmailAndPassword($fo->getEmail(), $fo->getPassword());
		$this->updateUserActivity($user);
		return $user;
	}
	
	/**
	 * Update User with latest activity date.
	 * @param User $user
	 */
	private function updateUserActivity(User $user)
	{
		$user->setLastActive(null);
		DAOFactory::getUserDAO()->save($user);
	}
	
	/**
	 * Change and send new password to email found.
	 * @param RecoverFO $fo
	 */
	public function recover(RecoverFO $fo)
	{
		$user = DAOFactory::getUserDAO()->findByEmail($fo->getEmail());
		$newPassword = $this->updateUserPassword($user);
		$this->sendPassword($user, $newPassword);
	}
	
	/**
	 * Generate and update User with new password.
	 * @param User $user
	 * @return string
	 */
	private function updateUserPassword(User $user)
	{
		$newPassword = PasswordGenerator::generate();
		$newPasswordHash = HashGenerator::generateMD5($newPassword);
		$user->setPassword($newPasswordHash);
		DAOFactory::getUserDAO()->save($user);
		return $newPassword;
	}

	/**
	 * New password is send to email of selected User.
	 * @param User $user
	 * @param string $password
	 */
	private function sendPassword(User $user, $password)
	{
		$subject = Bundle::get('recover.mail.subject');
		$message = $password;
		Mailer::send($user->getEmail(), $subject, $message);
	}
	
	/**
	 * Activate existing User.
	 * @param string $activeHash
	 */
	public function activate($activeHash)
	{
		$user = DAOFactory::getUserDAO()->findByActivation($activeHash);
		$user->setActive(true);
		DAOFactory::getUserDAO()->save($user);
	}
}

?>