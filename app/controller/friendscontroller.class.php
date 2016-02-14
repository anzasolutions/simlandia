<?php

/**
 * @author anza
 * @version 01-10-2010
 */
class FriendsController extends SessionController
{
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$users = $this->model->getUsers(40);
		$this->values->users = $users;
	}
	
	/**
	 * @Invocable
	 */
	protected function find()
	{
		if ($this->request->hasKey('friend'))
		{
			$name = Regex::replace('/[^A-Za-z0-9]/', '', $this->request->valueOf('friend'));
			Navigator::redirectTo($this->url->getParametersPath($name));
		}
		$name = $this->url->getParameter(0);
		if ($name == null)
		{
			return;
		}
		$this->getUsers($name);
	}
	
	private function getUsers($name)
	{
		try
		{
			$users = $this->model->getUsersWithName($name);
			$this->values->users = $users;
			$this->values->name = $name;
		}
		catch (NoResultException $e)
		{
			$this->request->error = Bundle::get('friends.users.not.found', $name);
		}
	}
	
	/**
	 * @Invocable
	 * @WebService
	 */
	// TODO: is this to be used anywhere?
	protected function callUser()
	{
//		if (!$this->request->hasKey('friend'))
//			return;
		$name = $this->request->friend;
		$friends = $this->model->getUsersWithName($name);
		$this->values->friends = $friends;
//		$f = '';
		foreach ($friends as $fr)
		{
			$f .= $fr->getLogin() . ' ';
			$f2 .= $fr->getFirstname() . ' ';
		}
//		echo ';;;';
		echo json_encode(array('returnValue'=>$f, 'ret2'=>$f2));
//		die();
	}
}

?>