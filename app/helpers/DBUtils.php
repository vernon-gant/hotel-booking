<?php

require_once APPROOT . "/libraries/Database.php";

/**
 * This is a simple class that contains some useful functions for database operations.
 */
class DBUtils {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	/**
	 * This function retrieves services with their prices from the database.
	 * @return array
	 */
	public function findServicesPrices() : array {
		$this->db->query("SELECT name, price
							  FROM services");
		return $this->db->resultSet();
	}
}