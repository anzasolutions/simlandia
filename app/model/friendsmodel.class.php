<?php

class FriendsModel extends AbstractModel
{
	public function getUser($login)
	{
		return DAOFactory::getUserDAO()->findByLogin($login);
	}
	
	public function getUsers($limit = 5)
	{
		return DAOFactory::getUserDAO()->findByLatestActive($limit);
	}
	
	public function getUsersWithName($name)
	{
		return DAOFactory::getUserDAO()->findByName($name);
	}
}

?>