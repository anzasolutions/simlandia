<?php

/**
 * Handle profile page.
 * @author anza
 * @version 09-04-2011
 */
class ProfileController extends ItemController
{
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->setAction('account');
	}
	
	/**
	 * @Invocable
	 */
	protected function account()
	{
		try
		{
			$profile = $this->model->getUser($this->id);
			$this->values->profile = $profile;
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			$this->redirectToError();
		}
	}
}

?>