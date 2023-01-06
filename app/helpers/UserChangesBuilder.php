<?php

/**
 * Class for building a query to change the user's data
 * Email, password, name, surname can be changed
 */
class UserChangesBuilder {

	/**
	 * Query for changing the user's data
	 * @var string
	 */
	private string $query;

	/**
	 * Array of values for the query
	 * @var array
	 */
	private array $args;

	/**
	 * Used for validation and extracting base email
	 * @var mixed
	 */
	private mixed $baseUser;

	/**
	 * @return string
	 */
	public function getQuery(): string {
		return $this->query;
	}

	/**
	 * @return array
	 */
	public function getArgs(): array {
		return $this->args;
	}

	public function __construct(mixed $baseUser) {
		$this->query = "UPDATE users
						SET";
		$this->args = array();
		$this->baseUser = $baseUser;
	}

	/**
	 * Adds email field to the query and pushes the value to the array
	 * @param string $email
	 * @return void
	 */
	private function email(string $email) : void {
		$this->query .= " email = ?,";
		$this->args[] = $email;
	}

	/**
	 * Adds first_name field to the query and pushes the value to the array
	 * @param string $first_name
	 * @return void
	 */
	private function first_name(string $first_name) : void {
		$this->query .= " first_name = ?,";
		$this->args[] = $first_name;
	}

	/**
	 * Adds last_name field to the query and pushes the value to the array
	 * @param string $last_name
	 * @return void
	 */
	private function last_name(string $last_name) : void {
		$this->query .= " last_name = ?,";
		$this->args[] = $last_name;
	}

	/**
	 * Adds password field to the query and pushes the value to the array
	 * @param string $password
	 * @return void
	 */
	private function password(string $password) : void {
		$this->query .= " password = ?";
		$this->args[] = $password;
	}

	/**
	 * If the last field is not password, then the comma is deleted
	 * from the end of the query
	 * @return void
	 */
	private function cleanQuery() : void {
		if (str_ends_with($this->query,","))
			$this->query = substr_replace($this->query,"",-1);
	}

	/**
	 * Performs validation by comparing value with null
	 * and the previous user's data
	 * @param string $name
	 * @param mixed $value
	 * @return bool
	 */
	private function validField(string $name, mixed $value) : bool {
		return $value != null and $value != $this->baseUser->$name;
	}

	/**
	 * Core method for building a query
	 * Firstly validates the data, then adds the field to the query
	 * Finally cleans the query and adds the WHERE clause
	 * @param array $fields
	 * @return $this
	 */
	public function build(array $fields) : self {
		if ($this->validField("email", $fields['email'])) $this->email($fields['email']);
		if ($this->validField("first_name", $fields['first_name'])) $this->first_name($fields['first_name']);
		if ($this->validField("last_name", $fields['last_name'])) $this->last_name($fields['last_name']);
		if ($this->validField("password", $fields['password'])) $this->password($fields['password']);
		$this->cleanQuery();
		$this->query .= "\nWHERE email = ?";
		$this->args[] = $this->baseUser->email;
		return $this;
	}

}