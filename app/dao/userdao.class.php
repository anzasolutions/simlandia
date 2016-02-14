<?php

/**
 * Manipulates User object in database.
 * @author anza
 * @version 06-10-2010
 */
class UserDAO extends DAO
{
//	public function findByIdSet($idSet)
//	{
//		$ids = Arrays::toStringSQL($idSet, ",");
//		
//		$sql = "SELECT id, login, firstname, lastname, email, online, gender, birthdate, avatar, lastActive
//				FROM user 
//				WHERE id in ({$ids})";
//		
//		$users = $this->execute($sql);
//		return $result = count($users) > 0 ? $users : null;
//	}
	
	//TODO: make sure this is taken care of as this is a transaction handling
//	public function findByLoginAndPassword($login, $password)
//	{
//		$query = $this->db->query();
//		$query->select()->from($this->type);
//		$query->where('login', $login)->add('password', $password)->add('active', 1)->limit(1);
//		
//		$user = $this->singleResult($query);
//		$user->setLastActive(null);
//		
//		$query2 = $this->db->query();
//		$query2->update($user)->where(self::ID, $user->getId());
//		
//		$query3 = $this->db->query();
//		$query3->select()->from($this->type);
//		$query3->where('logini', $login)->add('password', $password)->add('active', 1)->limit(1);
//		
//		$trans = $this->db->beginTransaction();
//		$trans->add($query2);
//		$trans->add($query);
//		$trans->add($query3);
//		$trans->add($query);
//		$trans->process();
//	}
	
	public function findByLoginAndPassword($login, $password)
	{
		$query = $this->simpleSelect();
		$query->where('login', $login)->add('password', $password)->add('active', 1);
		return $this->singleResult($query);
	}
	
	public function findByEmailAndPassword($email, $password)
	{
		$query = $this->simpleSelect();
		$query->where('email', $email)->add('password', $password)->add('active', 1);
		return $this->singleResult($query);
	}
	
	public function findByActivation($activation)
	{
		$query = $this->simpleSelect();
		$query->where('activation', $activation)->add('active', 0);
		return $this->singleResult($query);
	}
	
	public function findByLogin($login)
	{
		$query = $this->simpleSelect();
		$query->where('login', $login)->add('active', 1);
		return $this->singleResult($query);
	}
	
	public function findByLatestActive($limit)
	{
		$query = $this->simpleSelect();
		$query->where('active', TRUE)->orderBy('lastActive')->desc()->limit(0, $limit);
		return $this->result($query);
	}
	
	public function findByName($name)
	{
		$query = $this->simpleSelect();
		$query->where('login', $name.PERCENT, Query::LIKE)->add('active', 1)->orderBy('lastActive')->desc();
		return $this->result($query);
	}
	
	public function findByEmail($email)
	{
		$query = $this->simpleSelect();
		$query->where('email', $email)->add('active', 1);
		return $this->singleResult($query);
	}
	
	public function findByCommentTypeAndCommentTypeIdAndLimit($type, $typeId)
	{
		$subQuery = $this->db->query();
		$subQuery->distinct('userid')->from('Comment');
		$subQuery->where('type', $type)->add('typeId', $typeId)->orderBy('date')->desc();
		
		$query = $this->simpleSelect();
		$query->where('id', $subQuery, Query::IN)->add('active', 1);
		return $this->result($query);
	}
}

?>