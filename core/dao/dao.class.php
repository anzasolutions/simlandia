<?php

/**
 * Base Data Access Object.
 * Consists of all common methods and properties for all DAOs.
 * @author anza
 * @version 03-10-2010
 */
abstract class DAO
{
	const ID = 'id';
	const SET = 'set';
	
	protected $db;
	protected $type;

	public function __construct($type)
	{
		$this->db = DriverFactory::getDriver();
		$this->type = strtolower($type);
	}
	
	/**
	 * Insert or update a VO object in database.
	 * @param Object $vo VO object to be manipulated.
	 */
	public function save($object)
	{
		try
		{
			$this->checkType($object);
			$this->findById($object->getId());
			return $this->update($object);
		}
		catch (NoResultException $e)
		{
			return $this->insert($object);
		}
	}
	
	/**
	 * Update a VO object in database.
	 * @param object $vo
	 */
	public function update($object)
	{
		$query = $this->db->query();
		$query->update($object)->where(self::ID, $object->getId());
		return $this->getRows($query);
	}
	
	/**
	 * Insert a VO object in database.
	 * @param object $vo
	 */
	public function insert($object)
	{
		$query = $this->db->query();
		$query->insert($object);
		return $this->getRows($query);
	}
	
	/**
	 * Delete a VO object from database.
	 * @param Object $vo VO object to be manipulated.
	 */
	public function delete($object)
	{
		$this->checkType($object);
		$query = $this->db->query();
		$query->delete()->from($this->type)->where(self::ID, $object->getId());
		$this->execute($query);
	}

	/**
	 * Execute provided query in order to return specific set of VOs.
	 * @param string $query Query to be executed. 
	 * @return array Number of VO's for particular type of DAO. 
	 */
	public function execute(Query $query)
	{
		$objects = [];
		try
		{
			$this->db->execute($query);
			if ($this->db->count() > 0)
				while ($row = $this->db->result())
					$objects[] = $this->map($row);
		}
		catch (QueryException $e)
		{
			$e->getTraceAsString();
		}
		return $objects;
	}
	
	/**
	 * Map stdClass object to a DAO specific VO type;
	 * @param stdClass $object
	 * @return DAO specific VO type.
	 */
	private function map($object)
	{
		$type = new $this->type();
		foreach ($object as $field => $value)
		{
			$setter = self::SET.$field;
			$type->$setter($value);
		}
		return $type;
	}
	
	/**
	 * Expect unique result.
	 * @param Query $query
	 * @throws NoResultException
	 * @throws NonUniqueResultException
	 * @return Specific VO
	 */
	protected function singleResult(Query $query)
	{
		$result = $this->result($query);
		if (sizeof($result) > 1)
			throw new NonUniqueResultException();
		return $result[0];
	}
	
	/**
	 * Return result of query.
	 * @param Query $query
	 * @throws NoResultException
	 * @return array of specific VO type
	 */
	protected function result(Query $query)
	{
		$result = $this->execute($query);
		if ($result == null)
			throw new NoResultException();
		return $result;
	}
	
	/**
	 * Execute query and return number of rows affected.
	 * @param string $query
	 * @throws DuplicateException
	 * @return number of rows affected
	 */
	protected function getRows(Query $query)
	{
		$this->execute($query);
		if ($this->db->error() != null)
			throw new DuplicateException($this->db->error());
		return $this->db->affected();
	}
	
	/**
	 * Given object must be compatible with DAO type. 
	 * @param object $object
	 * @throws IncorrectTypeException
	 */
	protected function checkType($object)
	{
		if (!$object instanceof $this->type)
			throw new IncorrectTypeException(ReflectionUtil::getObjectType($object));
	}
	
	/**
	 * Common search based on a type ID.
	 * @param integer $id
	 * @return object type
	 */
	public function findById($id)
	{
		$query = $this->simpleSelect();
		$query->where(self::ID, $id);
		return $this->singleResult($query);
	}
	
	/**
	 * Wrap select all query.
	 * @return Query
	 */
	protected function simpleSelect()
	{
		$query = $this->db->query();
		$query->select()->from($this->type);
		return $query;
	}
	
	/**
	 * Counts query result rows.
	 * @param Query $query
	 */
	protected function count(Query $query)
	{
		$result = $this->result($query);
		return sizeof($result);
	}
	
	/**
	 * Get all rows of given type.
	 * @return array of specific VO type objects
	 */
	public function findAll()
	{
		$query = $this->simpleSelect();
		return $this->result($query);
	}
}

?>