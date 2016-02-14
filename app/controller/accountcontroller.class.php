<?php

/**
 * Handle operations on user account.
 * @author anza
 * @version 12-04-2011
 */
class AccountController extends SessionController
{
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->setAction('edit');
	}
	
	/**
	 * Logout and destroy session.
	 * Redirect to app starting point.
	 * @Invocable
	 */
	protected function logout()
	{
		Session::getInstance()->destroy();
		Navigator::redirectTo();
	}
	
	/**
	 * @Invocable
	 */
	// TODO: to be completed
	protected function update()
	{
		echo 'here I can update my account';
	}
	
	/**
	 * @Invocable
	 */
	// TODO: to be completed
	protected function edit()
	{
	}
}

?>