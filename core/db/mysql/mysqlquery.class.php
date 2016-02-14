<?php

/**
 * Object representation of MySQL query.
 * @author anza
 * @since 30-11-2010
 */
class MySQLQuery implements Query
{
	const LIMIT = ' LIMIT ';
	
	private $driver;
	private $query;
	
	public function __construct(Driver $driver)
	{
		$this->driver = $driver;
	}
	
	public function select($columns = null)
	{
		$columns = $columns == null ? STAR : $columns;
		$this->query .= self::SELECT . $columns;
		return $this;
	}
	
	public function distinct($columns = null)
	{
		$columns = $columns == null ? STAR : $columns;
		$this->query .= self::SELECT . self::DISTINCT . $columns;
		return $this;
	}
	
	public function from($tables)
	{
		$this->query .= self::FROM . strtolower($tables);
		return $this;
	}
	
	public function where($column, $condition, $operator = null)
	{
		$this->buildCondition(self::WHERE, $column, $condition, $operator);
		return $this;
	}
	
	public function add($column, $condition, $operator = null)
	{
		$this->buildCondition(self::ADD, $column, $condition, $operator);
		return $this;
	}
	
	public function addColumns($column1, $column2, $operator = null)
	{
		$this->buildColumns(self::ADD, $column1, $column2, $operator);
		return $this;
	}
	
	public function orElse($column, $condition, $operator = null)
	{
		$this->buildCondition(self::ORELSE, $column, $condition, $operator);
		return $this;
	}
	
	// TODO: this must be improved to allow column as condition not to be escaped!
	private function buildColumns($type, $column1, $column2, $operator = null)
	{
		$operator = $operator == null ? EQUALS : $operator;
		$this->query .= $type . $column1 . SPACE . $operator . SPACE . $column2;
	}
	
	// TODO: this must be improved to allow column as condition not to be escaped!
	private function buildCondition($type, $column, $condition, $operator = null)
	{
		$condition = $operator == Query::IN ? LBRACKET . $condition . RBRACKET : $condition;
		if (is_string($condition) && $operator != Query::IN)
			$condition = SQUOTE . $this->driver->escape($condition) . SQUOTE;
		$operator = $operator == null ? EQUALS : $operator;
		$this->query .= $type . $column . SPACE . $operator . SPACE . $condition;
	}
	
	public function orderBy($columns)
	{
		$this->query .= self::ORDER . $columns;
		return $this;
	}
	
	public function desc()
	{
		$this->query .= self::DESC;
		return $this;
	}
	
	public function asc()
	{
		$this->query .= self::ASC;
		return $this;
	}
	
	public function limit($position, $limit)
	{
		$this->query .= self::LIMIT . $position . COMMA . $limit;
		return $this;
	}
	
	public function update($object)
	{
		$properties = $this->getProperties($object);
		$this->query .= self::UPDATE . strtolower(get_class($object)) . self::SET;
		foreach ($properties as $name => $value)
		{
			$this->query .= $name . SPACE . EQUALS . SQUOTE . $this->driver->escape($value) . SQUOTE . COMMA . SPACE;
		}
		$this->trimEnd();
		return $this;
	}
	
	private function getProperties($object)
	{
		$reflection = new ReflectionObject($object);
		$properties = $reflection->getProperties();
		foreach ($properties as $property)
		{
			$getter = 'get'.$property->getName();
			$result[$property->getName()] = $object->$getter();
		}
		return $result;
	}
	
	private function trimEnd()
	{
		$this->query = substr_replace($this->query , '', -2);
	}
	
	public function insert($object)
	{
		$properties = $this->getProperties($object);
		$this->query .= self::INSERT . strtolower(get_class($object)) . SPACE . LBRACKET;
		foreach ($properties as $name => $value)
		{
			$this->query .= $name . COMMA . SPACE;
		}
		$this->trimEnd();
		$this->query .= RBRACKET . self::VALUES . LBRACKET;
		foreach ($properties as $name => $value)
		{
			$this->query .= SQUOTE . $this->driver->escape($value) . SQUOTE . COMMA . SPACE;
		}
		$this->trimEnd();
		$this->query .= RBRACKET;
		return $this;
	}
	
	public function delete()
	{
		$this->query .= self::DELETE;
		return $this;
	}
	
	public function __toString()
	{
		return $this->query;
	}
}

?>