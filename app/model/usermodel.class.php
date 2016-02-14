<?php

abstract class UserModel extends AbstractModel
{
//	public function getUser($id)
//	{
//		return $this->getUserDAO()->findById($id);
//	}
	
	
	
	
	
	
	
	
	//TODO: implementing this method use too much resources
	//TODO: to be replaced by a search mechanism form?
//	public function countAllUsers()
//	{
//		$sql = 'SELECT login 
//				FROM user';
//
//		//$sql = $this->db->escape($sql);
//		$this->db->execute($sql);
//		return $this->db->count();
//	}

	// TODO: need to think about putting this somewhere else?
//	public function getUserByProfileNumber($profileNumber)
//	{
//		$dao = $this->dao->getDAO("User");
//		return $dao->findUserById($profileNumber);
//	}
//	protected function getUserDAO()
//	{
//		return DAOFactory::getDAO('User');
//	}

//	public function getUser($id)
//	{
//		return $this->getUserDAO()->findById($id);
//	}

	public function getUser($login)
	{
		return DAOFactory::getUserDAO()->findByLogin($login);
	}
} 

?>