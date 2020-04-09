<?php

/**
 * DB Class - A custom and simple object oriented database class
 *
 * Copyright 2019
 * @author Ray U. Abanid
 * @version v1.0
 */

class DB {

	protected $DB_con;
	protected $_table;
	protected $query;

	private $DB_HOST = 'localhost';
	private $DB_USERNAME = 'root';
	private $DB_PASSWORD = '';
	private $DB_NAME = 'crud_sample';
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->connect();
	}

	/**
	 * Database connection
	 */
	private function connect()
	{
		try{
			$this->DB_con = new PDO("mysql:host={$this->DB_HOST};dbname={$this->DB_NAME}",$this->DB_USERNAME,$this->DB_PASSWORD);
			$this->DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			die('Failed to connect to DB: '.$e->getMessage());
		}
	}

	/**
	 * Close connection
	 */
	public function close()
	{
		$this->DB_con = null;
	}

	/**
	 * Bind where statement
	 *
	 * @param array $data
	 * @param string $delimiter
	 */
	private function whereStatement($data = array(), $delimiter)
	{
		end($data);
		$lastElement = key($data);

		$stmt = '';
		foreach ($data as $key => $value ) {
			$stmt .= "{$key} = :{$key}";
			if ($key != $lastElement) {
				$stmt .= "{$delimiter}";
			}
		}

		return $stmt;
	}

	/**
	 * Bind statement on sql
	 *
	 * @param array $data
	 * @param string $delimiter
	 * @param string $type
	 */
	private function bindStatement($data = array(), $delimiter = ', ', $type)
	{
		end($data);
		$lastElement = key($data);

		$stmt = '';
		foreach ($data as $key => $value ) {
			if ( $type == 'insert' ) {
				$stmt .= ":{$key}";
			} else {
				$stmt .= "{$key} = :{$key}";
			}
			if ($key != $lastElement) {
				$stmt .= "{$delimiter}";
			}
		}

		return $stmt;
	}

	public function last_id(){
        return $this->DB_con->lastInsertId();
    }

	/**
	 * Get all rows
	 *
	 * @param string $select - The fields to be selected by default * to select all the columns
	 * @param string $order_by - The column order
	 * @param string $order - The order of the result by default DESC
	 * @param string $fetchStyle - How the row will be returned. E.g. PDO::FETCH_OBJ return as objects
	 */
	public function getAll($select = '*', $order_by = '', $order = 'DESC', $fetchStyle = '')
	{
		try {
			$sql = "SELECT {$select} FROM {$this->_table}";

			if (!empty($order_by)) {
				$sql .= " ORDER BY $order_by $order";
			} 

			$stmt = $this->DB_con->prepare($sql);
			$stmt->execute();

			$fetchStyle = empty($fetchStyle) ? PDO::FETCH_OBJ : $fetchStyle;
			$result = $stmt->fetchAll($fetchStyle);
			return !empty($result) ? $result : false;

		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Get row(s) depending on the WHERE clause
	 *
	 * @param array $where - The WHERE clause as array
	 * @param string $select - The fields to be selected by default * to select all the columns
	 * @param boolean $single - Determine if the result will be return as single row or not by default FALSE
	 * @param string $fetchStyle - How the results will be returned. E.g. PDO::FETCH_OBJ return as objects
	 */
	public function getBy($where = array(), $select = '*', $single = FALSE, $fetchStyle = '')
	{
		try {
			$whereStmt = $this->whereStatement($where, ' AND ');

			$sql = "SELECT {$select} FROM {$this->_table} WHERE {$whereStmt}";
			$stmt = $this->DB_con->prepare($sql);
			$stmt->execute($where);

			$fetchStyle = empty($fetchStyle) ? PDO::FETCH_OBJ : $fetchStyle;
			// If single is TRUE will return as single row
			if ($single) {
				$result = $stmt->fetch($fetchStyle);
				return !empty($result) ? $result : false;
			}

			$result = $stmt->fetchAll($fetchStyle);
			return !empty($result) ? $result : false;

		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Insert new records
	 *
	 * @param array $data - The data to be inserted as array
	 */
	public function insert($data = array())
	{
		try {
			if (!$this->DB_con) {
				$this->connect();
			}
			$keys = array_keys($data);
			$fields = implode(', ', $keys);

			$values = $this->bindStatement($data, ', ', 'insert');

			$sql = "INSERT INTO {$this->_table} ({$fields}) VALUES ($values)";
			$stmt = $this->DB_con->prepare($sql);
			$result = $stmt->execute($data);

			return $result ? $this->DB_con->lastInsertId() : false;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	} 

	

	/**
	 * Update records
	 *
	 * @param array $data - The data to be update as array
	 * @param array $where - The WHERE clause as array
	 */
	public function update($data = array(), $where = array())
	{
		try {
			$setStmt = $this->bindStatement($data, ', ', 'update');

			$sql = "UPDATE {$this->_table} SET {$setStmt}";

			if (!empty($where)) {
				$whereStmt = $this->whereStatement($where, ' AND ');
				$sql .= " WHERE {$whereStmt}";
			}

			$stmt = $this->DB_con->prepare($sql);

			$data = array_merge($data, $where);
			return $stmt->execute($data) ? true : false;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Delete records
	 *
	 * @param array $where - The WHERE clause as array
	 */
	public function delete($where = array())
	{
		try {
			$whereStmt = $this->whereStatement($where, ' AND ');

			$sql = "DELETE FROM {$this->_table} WHERE {$whereStmt}";
			$stmt = $this->DB_con->prepare($sql);

			return $stmt->execute($where) ? true: false;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Execute query statement and return as object
	 *
	 * @param string $query - The query statement
	 * @param array $bindParam - The parameter to be bind in prepared statement
	 */
	public function query($query, $bindParam = array())
	{
		try {
			$this->query = $this->DB_con->prepare($query);

			if (!empty($bindParam)) {
				$this->query->execute($bindParam);
			}
			$this->query->execute();

			return $this;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Returns the number of rows
	 */
	public function numRows()
	{
		try {
			return $this->query->fetchColumn();
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Returns an array containing all of the result set rows
	 * @param string $fetchStyle - How the row will be returned. E.g. PDO::FETCH_OBJ return as objects
	 */
	public function fetchAll($fetchStyle = '')
	{
		try {
			$fetchStyle = empty($fetchStyle) ? PDO::FETCH_OBJ : $fetchStyle;
			$result = $this->query->fetchAll($fetchStyle);

			return !empty($result) ? $result : false;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}

	/**
	 * Returns a single row
	 * @param string $fetchStyle - How the row will be returned. E.g. PDO::FETCH_OBJ return as objects
	 */
	public function fetch($fetchStyle = '')
	{
		try {
			$fetchStyle = empty($fetchStyle) ? PDO::FETCH_OBJ : $fetchStyle;
			$result = $this->query->fetch($fetchStyle);

			return !empty($result) ? $result : false;
		} catch (PDOException $e) {
			die('Query Error: '.$e->getMessage());
		}
	}
}
	
	