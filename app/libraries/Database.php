<?php


/**
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */
class Database {

	private string $host = DB_HOST;
	private string $user = DB_USER;
	private string $pass = DB_PASS;
	private string $dbName = DB_NAME;

	private mysqli $dbh;
	private mysqli_stmt $stmt;
	private string $error;

	public function __construct() {
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		try {
			$this->dbh = new mysqli($this->host, $this->user, $this->pass, $this->dbName, 3306);
		} catch (mysqli_sql_exception $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	// Prepare statement with query
	public function query(string $sql, ...$values): void {
		if ($this->stmt = $this->dbh->prepare($sql)) {
			if (array_count_values($values) > 0) {
				$types = '';
				$args_ref = array();
				foreach ($values as &$value) {
					$types .= $this->_gettype($value);
					$args_ref[] = &$value;
				}
				array_unshift($args_ref, $types);
				call_user_func_array(array($this->stmt, 'bind_param'), $args_ref);
			}
			$this->stmt->execute();
		} else {
			exit('Unable to prepare MySQL statement (check your syntax) - ' .
				$this->dbh->error);
		}
	}

	// Get single record as object
	public function singleRow() {
		$result = $this->stmt->get_result();
		return $result->fetch_object();
	}

	// Get result set as array of objects
	public function resultSet(): array {
		$result = $this->stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function rowCount(): int|string {
		$this->stmt->store_result();
		return $this->stmt->num_rows;
	}

	public function affectedRows(): int|string {
		return $this->stmt->affected_rows;
	}

	public function lastInsertID(): int|string {
		return $this->stmt->insert_id;
	}

	private function _gettype($var): string {
		if (is_string($var))
			return 's';
		if (is_float($var))
			return 'd';
		if (is_int($var))
			return 'i';
		return 'b';
	}

	public function close(): bool {
		return $this->dbh->close();
	}
}