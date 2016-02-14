<?php

/**
 * Base database driver.
 * Consists of all common methods and properties for all database drivers.
 * @author anza
 * @since 04-10-2010
 */
abstract class Driver
{
	protected $connection;
	protected $result;
	protected $config;
    
	public function __construct($config)
	{
		$this->config = $config;
		$this->connect();
	}
	
	/**
	 * Explicitly called connects to a database.
	 */
	public abstract function connect();
	
	/**
	 * Construct convinient query.
	 * @return object Query
	 */
	public abstract function query();
	
	/**
	 * Executes SQL query against database.
	 * @param string $sql SQL query to be executed against database.
	 */
	public abstract function execute(Query $query);
	
	/**
	 * Turn on/off autocommit mode.
	 * Used for handling transactions.
	 * @param boolean $mode true on / false off
	 */
	public abstract function autocommit($mode);
	
	/**
	 * Confirm execution of query in transaction.
	 */
	public abstract function commit();
	
	/**
	 * Revert queries in transaction.
	 */
	public abstract function rollback();
	
	/**
	 * Counts elements based on provided query
	 */
	public abstract function count();
	
	/**
	 * Escapes non-ASCII characters before input to database.
	 * String is immunized and more secure for further use.
	 * @param string $string String to be escaped and used within SQL query.
	 */
	public abstract function escape($string);
	
	/**
	 * Clear query result.
	 */
	public abstract function flush();
	
	/**
	 * Close database connection.
	 */
	public abstract function close();
	
	/**
	 * Return any errors occured.
	 */
	public abstract function error();
	
	/**
	 * Return obtained query result.
	 */
	public abstract function result();
	
	/**
	 * Get numer of affected rows in query.
	 */
	public abstract function affected();
	
	/**
	 * Initialize transaction.
	 */
	public abstract function beginTransaction();
	
	public function __destruct()
	{
		$this->flush();
		$this->close();
	}
}

?>