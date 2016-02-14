<?php

/**
 * Encapsulate PHP MySQLi extension.
 * Operate only on MySQL type database.
 * @author anza
 * @version 03-10-2010
 */
class MySQLDriver extends Driver
{
	public function connect()
	{
		try
		{
			$this->connection = mysqli_init();
			$this->connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
			$this->connection->real_connect($this->config->hostname, $this->config->username, $this->config->password, $this->config->database);
			if ($this->connection->connect_error)
			{
				throw new ConnectionException('Cannot connect to database!');
			}
		}
		catch (ConnectionException $e)
		{
			$e->getTraceAsString();
		}
	}
	
	public function query()
	{
		return new MySQLQuery($this);
	}
	
	public function execute(Query $query)
	{
		$this->result = $this->connection->query($query);
		if ($this->error() != null)
		{
			throw new QueryException($this->error());
		}
	}
	
	public function autocommit($mode)
	{
		$this->connection->autocommit($mode);
	}
	
	public function commit()
	{
		$this->connection->commit();
	}
	
	public function rollback()
	{
		$this->connection->rollback();
	}
	
	public function beginTransaction()
	{
		return new Transaction($this);
	}
	
	public function count()
	{
		return $this->result->num_rows;
	}
	
	public function escape($string)
	{
		return $this->connection->real_escape_string($string);
	}
	
	public function flush()
	{
		$this->result = null;
	}
	
	public function close()
	{
		$thread_id = $this->connection->thread_id;
		$this->connection->kill($thread_id);
		$this->connection->close();
	}
	
	public function error()
	{
		return $this->connection->error;
	}
	
    /**
     * Return result as objects.
     */
    public function result()
    {
        return $this->result->fetch_object();
    }
	
    /**
     * Return number of affected rows.
     */
    public function affected()
    {
        return $this->connection->affected_rows;
    }
}

?>