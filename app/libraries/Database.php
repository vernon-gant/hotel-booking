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
	private mysqli_result $result;

	public function __construct() {
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		try {
			$this->dbh = new mysqli($this->host, $this->user, $this->pass, $this->dbName, 3306);
		} catch (mysqli_sql_exception $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	// Prepare statement with query and bind values
	// or just execute a query without binding values
	public function query(string $sql, ...$values): void {
		if ($this->stmt = $this->dbh->prepare($sql)) {
			if (count($values) > 0) {
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
			// Saves the result of the query if it is a SELECT query
			// (needed for the singleRow, resultSet and rowCount methods)
			if (str_contains($sql,"SELECT")) {
				$this->result = $this->stmt->get_result();
			}
		} else {
			exit('Unable to prepare MySQL statement (check your syntax) - ' .
				$this->dbh->error);
		}
	}

	// Get single record as object
	public function singleRow() {
		return $this->result->fetch_object();
	}

	// Get result set as array of objects
	public function resultSet(): array {
		return $this->result->fetch_all(MYSQLI_ASSOC);
	}

	// Get row count
	public function rowCount(): int|string {
		return $this->result->num_rows;
	}

	// Get affected rows
	public function affectedRows(): int|string {
		return $this->stmt->affected_rows;
	}

	// Get last inserted ID
	public function lastInsertID(): int|string {
		return $this->stmt->insert_id;
	}

	// Get type of variable
	private function _gettype($var): string {
		if (is_string($var))
			return 's';
		if (is_float($var))
			return 'd';
		if (is_int($var))
			return 'i';
		return 'b';
	}

	// Close connection to database
	public function close(): bool {
		return $this->dbh->close();
	}
}