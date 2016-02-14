<?php

/**
 * Provide common persistence interface.
 * @author anza
 * @since 30-11-2010
 */
interface Query
{
	const SELECT = 'SELECT ';
	const DISTINCT = 'DISTINCT ';
	const FROM = ' FROM ';
	const WHERE = ' WHERE ';
	const ADD = ' AND ';
	const ORELSE = ' OR ';
	const ORDER = ' ORDER BY ';
	const DESC = ' DESC ';
	const ASC = ' ASC ';
	const UPDATE = 'UPDATE ';
	const INSERT = 'INSERT INTO ';
	const SET = ' SET ';
	const VALUES = ' VALUES ';
	const DELETE = 'DELETE ';
	const LIKE = ' LIKE ';
	const IN = ' IN ';
	const ASAS = ' AS ';
	
	/**
	 * Represent SQL keyword SELECT. 
	 * @param string $columns
	 */
	public function select($columns = null);
	
	/**
	 * Represent SQL query SELECT DISTINCT. 
	 * @param string $columns
	 */
	public function distinct($columns = null);
	
	/**
	 * Represent SQL keyword FROM. 
	 * @param string $tables
	 */
	public function from($tables);
	
	/**
	 * Represent SQL keyword WHERE.
	 * @param string $column
	 * @param string $condition
	 * @param string $operator
	 */
	public function where($column, $condition, $operator = null);
	
	/**
	 * Represent SQL keyword AND.
	 * @param string $column
	 * @param string $condition
	 * @param string $operator
	 */
	public function add($column, $condition, $operator = null);
	
	/**
	 * Represent SQL keyword AND for two columns.
	 * @param string $column1
	 * @param string $column2
	 * @param string $operator
	 */
	public function addColumns($column1, $column2, $operator = null);
	
	/**
	 * Represent SQL keyword OR.
	 * @param string $column
	 * @param string $condition
	 * @param string $operator
	 */
	public function orElse($column, $condition, $operator = null);
	
	/**
	 * Represent SQL keyword ORDER BY. 
	 * @param string $columns
	 */
	public function orderBy($columns);
	
	/**
	 * Represent SQL keyword DESC. 
	 */
	public function desc();
	
	/**
	 * Represent SQL keyword ASC. 
	 */
	public function asc();
	
	/**
	 * Represent SQL keyword LIMIT. 
	 * @param string $position
	 * @param string $limit
	 */
	public function limit($position, $limit);
	
	/**
	 * Represent SQL keyword UPDATE. 
	 * @param string $type
	 */
	public function update($type);
	
	/**
	 * Represent SQL keyword INSERT. 
	 * @param string $type
	 */
	public function insert($type);
	
	/**
	 * Represent SQL keyword DELETE. 
	 */
	public function delete();
}

?>