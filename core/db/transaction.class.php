<?php

/**
 * Handles transactions of queries.
 * @author anza
 * @version 30-11-2010
 */
class Transaction
{
	private $driver;
	private $queries = array();
	
	public function __construct(Driver $driver)
	{
		$this->driver = $driver;
	}
	
	/**
	 * Add query to a pool of queries to be executed.
	 * @param Query $query
	 */
	public function add(Query $query)
	{
		$this->queries[] = $query;
	}
	
	/**
	 * Process all transaction queries.
	 */
	public function process()
	{
		if (sizeof($this->queries) == 0)
			return;
			
		$this->driver->autocommit(false);
		
		try
		{
			foreach ($this->queries as $query)
				$this->driver->execute($query);
			$this->driver->commit();
		}
		catch (QueryException $e)
		{
			$this->driver->rollback();
			$e->getTraceAsString();
		}
		
		$this->driver->autocommit(true);
	}
}

?>