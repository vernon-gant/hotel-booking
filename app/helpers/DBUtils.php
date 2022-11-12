<?php

require_once APPROOT . "/libraries/Database.php";

class DBUtils {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function findServicesPrices() : array {
		$this->db->query("SELECT name, price
							  FROM services");
		return $this->db->resultSet();
	}
}